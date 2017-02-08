<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 kurobuta.jp Development Team
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     kurobuta.jp Development Team
 * @link       https://kurobuta.jp
 */

namespace Sample;

// Logger
use \Monolog\Logger;
use \Monolog\Handler\ChromePHPHandler;

// Model
use \Sample\Model\Exif;
use \Sample\Model\Address;
use \Sample\Model\Html;

/**
 * Class Exifコントローラー
 */
class Controller_Exif extends \Controller
{
	// サービスの説明
	const SERVICE_TITLE = '写真から住所';
	const SERVICE_SUB_TITLE = 'Exifデータから住所を取得';
	const SERVICE_DESCRIPTION = 'アップロード（複数）した写真、もしくはURLから住所を表示。';
	const SERVICE_KEYWORD = 'php,fuelphp,photo,address,exif';

	// 動作設定
	const EARTH_RADIUS = 6378.137; // 地球の半径(km)
	const MAX_FILES = 10; // 最大ファイル数
	const LOCATION_NOW = 'いまココ';

	// Google map zoom level (km)
	private static $_google_map_zoom_level = array(
		'18' => 0.05, '17' => 0.1, '16' => 0.2, '15' => 0.5, '14' => 1, '13' => 2, '12' => 4, '11' => 5, '10' => 10,
		'9' => 20, '8' => 50, '7' => 100, '6' => 200, '5' => 500, '4' => 1000, '3' => 2000, '2' => 4000, '1' => 5000, '0' => 10000);

	// Logger
	private $_log = null;
	// Model
	private $_exif = null;
	private $_address = null;
	private $_html = null;

	/**
	 * 前処理
	 *
	 */
	public function before()
	{
		parent::before();
		$this->_log = new Logger(__CLASS__);
		$this->_log->pushHandler(new ChromePHPHandler());
	}

	/**
	 * インデックス処理振り分け
	 *
	 * @return \Fuel\Core\View
	 */
	public function action_index()
	{
		\Log::info('[START]'.__METHOD__);
		$results = array();
		// Model生成
		$this->_exif = new Exif();
		$this->_address = new Address();
		$this->_html = new Html();
		// View生成 レイアウトビューを作成する
		$view = \View::forge('layout');
		// 画面の説明を設定
		$view->set_global('title', self::SERVICE_TITLE);
		$view->set_global('sub_title', self::SERVICE_SUB_TITLE);
		$view->set_global('description', self::SERVICE_DESCRIPTION, false);
		$view->set_global('keyword', self::SERVICE_KEYWORD);
		//View生成 変数としてビューを割り当てる、遅延レンダリング
		$view->head = \View::forge('head');
		$view->application_head = \View::forge('exif/script_before');
		$view->header = \View::forge('header');
		$view->top = \View::forge('top');
		$view->content = \View::forge('exif/content');
		$view->footer = \View::forge('footer');
		$view->application_footer = \View::forge('exif/script_after');
		$type_name = '';
		try {
			// 要求別設定
			switch (\Input::post('processing')) {
				case SERVICE_CLEAR_KEY:
					// クリア
					$type_name = SERVICE_CLEAR_NAME;
					break;
				case SERVICE_UPLOAD_KEY:
					// アップロード
					$type_name = SERVICE_UPLOAD_NAME;
					$results = $this->upload();
					break;
				case SERVICE_URL_KEY:
					// URLから画像を取得
					$type_name = SERVICE_URL_NAME;
					$str = !empty(\Input::post('input')) ? \Input::post('input') : '';
					$results = $this->url_image($str);
					break;
				default :
					$type_name = SERVICE_ROOT_NAME;
					break;
			}
		} catch (\HttpServerErrorException $e) {
			$error_message = '住所の取得に失敗しました('.$type_name.')。';
			$view->content->message = $error_message;
			\Log::error($error_message);
		} finally {
			$view->application_footer->results = $results;
			$view->content->results = $results;
			\Log::info('[END]'.__METHOD__.', '.$type_name);
			return $view;
		}
	}

	/**
	 * アップロードファイルから住所変換を取得
	 *
	 * @return array
	 */
	private function upload()
	{
		$results = array();
		$files = array();

		\Log::info('[START]'.__METHOD__);
		// アップロード処理
		if (\Upload::is_valid()) {
			\Upload::save(); // ファイル格納
			foreach (\Upload::get_files() as $node) {
				\log::info('FILE:'.print_r($node, true));
				array_push($files,
					array(
						'pass_name' => $node['saved_to'],
						'file_name' => $node['saved_as'],
					)
				);
			}
			// 住所取得処理
			$results = $this->locations($files);
			// アップロードファイルの削除
			foreach ($files as $node) {
				// ファイル削除
				if (!unlink($node['pass_name'].$node['file_name'])) {
					$error_message = 'ファイルの削除に失敗しました('.$node[pass_name].$node[file_name].')。';
					\Log::error($error_message);
				}
			}
		}
		\Log::info('[END]'.__METHOD__);
		return $results;
	}

	/**
	 * URLから住所変換を取得
	 *
	 * @return array
	 */
	private function url_image($value)
	{
		\Log::info('[START]'.__METHOD__);
		// URLから画像のパスを取得
		$this->_html->set_url($value);
		$files = $this->_html->get_images_file_pass();
		// 住所取得処理
		$results = $this->locations($files);
		\Log::info('[END]'.__METHOD__);
		return $results;
	}

	/**
	 * ロケーション情報
	 *
	 * @param array $files
	 * @return array
	 */
	private function locations($files = array())
	{
		$items = array();
		$latitude_max = 0;
		$latitude_min = PHP_INT_MAX;
		$longitude_max = 0;
		$longitude_min = PHP_INT_MAX;
		$north_south_km = 0;
		$east_west_km = 0;
		$zoom_level = 0;
		$count = 0;

		// geo location On
		$items = $this->geo_location_On($items);
		// ファイルから住所取得
		foreach ($files as $node) {
			if (self::MAX_FILES > $count) {
				// ファイルの拡張子チェック
				$extensions = str_getcsv(IMAGE_EXTENSIONS);
				$info = new \SplFileInfo($node['file_name']);
				if (in_array($info->getExtension(), $extensions)) {
					// 住所取得
					$this->_exif->set_pass_name($node['pass_name']);
					$this->_exif->set_file_name($node['file_name']);
					\Log::info('upload: '.$node['pass_name'].$node['file_name']);
					$this->_exif->read(); // Exifの読み込み
					\log::info('EXIF:'.mb_convert_encoding(print_r($this->_exif->get_exif(), true), 'UTF-8'));
					$address = $this->_exif->get_address();
					// サムネイル生成
					$this->_exif->thumbnail_create();
					// 方角画像生成
					$this->_exif->direction_image_create();
					// 住所が存在するものを格納
					if (!empty($address)) {
						$latitude = $this->_exif->get_latitude();
						$longitude = $this->_exif->get_longitude();
						$this->_log->addInfo('北緯:'.$latitude);
						$this->_log->addInfo('東経:'.$longitude);
						$this->_log->addInfo('住所:'.$address);
						array_push($items,
							array(
								'image_name' => $this->_exif->get_file_name(),
								'image' => $this->_exif->get_thumbnail(),
								'address' => $address,
								'latitude' => $latitude,
								'longitude' => $longitude,
								'direction' => $this->_exif->get_direction_image()
							)
						);
						$count++;
					}
				}
			}
		}
		// 北緯東経範囲計算
		foreach ($items as $node) {
			if ($node['latitude'] > $latitude_max) $latitude_max = $node['latitude'];
			if ($node['latitude'] < $latitude_min) $latitude_min = $node['latitude'];
			if ($node['longitude'] > $longitude_max) $longitude_max = $node['longitude'];
			if ($node['longitude'] < $longitude_min) $longitude_min = $node['longitude'];
		}
		$latitude_position = ($latitude_max + $latitude_min) / 2; // 北緯中心
		$longitude_position = ($longitude_max + $longitude_min) / 2; // 東経中心
		if (count($items) > 0) {
			// 北緯の範囲(km)
			$north_south_km = deg2rad($latitude_max - $latitude_min) * self::EARTH_RADIUS;
			// 東経の範囲(km)
			$east_west_km = cos(deg2rad($latitude_max)) * self::EARTH_RADIUS * deg2rad($longitude_max - $longitude_min);
			// Zoom level
			$km_max = max(array($north_south_km, $east_west_km));
			foreach (self::$_google_map_zoom_level as $key => $value) {
				$value = $value * 2;
				if ($value < $km_max) $zoom_level = $key;
				else break;
			}
		}
		// ログ出力
		$this->_log->addInfo('北緯-最大:'.$latitude_max);
		$this->_log->addInfo('北緯-最小:'.$latitude_min);
		$this->_log->addInfo('北緯-最大:'.$longitude_max);
		$this->_log->addInfo('北緯-最小:'.$longitude_min);
		$this->_log->addInfo('北緯-ポジション:'.$latitude_position);
		$this->_log->addInfo('東経-ポジション:'.$longitude_position);
		$this->_log->addInfo('北緯の範囲(km):'.$north_south_km.'km');
		$this->_log->addInfo('東経の範囲(km):'.$east_west_km.'km');
		$this->_log->addInfo('Zoomレベル:'.$zoom_level.'('.self::$_google_map_zoom_level[$zoom_level].'km)');
		// 結果
		return array(
			'items' => $items,
			'latitude_position' => $latitude_position,
			'longitude_position' => $longitude_position,
			'zoom_level' => $zoom_level
		);
	}

	/**
	 * GEO LOCATION から位置情報生成
	 *
	 * @param array $items
	 * @return array
	 * @throws \Exception
	 */
	private function geo_location_On($items = array())
	{
		$latitude = !empty(\Input::post('latitude')) ? (double)\Input::post('latitude') : null;
		$longitude = !empty(\Input::post('longitude')) ? (double)\Input::post('longitude') : null;
		if (isset($latitude) and isset($longitude)) {
			$this->_log->addInfo('geo location latitude:'.$latitude);
			$this->_log->addInfo('geo location longitude:'.$longitude);
			$this->_address = new Address();
			$this->_address->set_latitude($latitude);
			$this->_address->set_longitude($longitude);
			$this->_address->re_geocode();
			$address = $this->_address->get_address();
			$this->_address->image_create(self::LOCATION_NOW);
			array_push($items,
				array(
					'image_name' => self::LOCATION_NOW,
					'image' => $this->_address->get_image(),
					'address' => $address,
					'latitude' => $latitude,
					'longitude' => $longitude,
				)
			);
		}
		return $items;
	}

}
