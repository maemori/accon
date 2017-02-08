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

namespace Sample\Model;

// Logger
use \Monolog\Logger;
use \Monolog\Handler\ChromePHPHandler;

/**
 * Exifモデル
 *
 * Exifに関わる処理を行う.
 */
class Exif extends Photo
{
	const THUMBNAIL_SIZE = 100; //サムネイルのサイズ
	const ARROW_IMAGE = 'images/arrow_02.png'; // 方角イメージ

	// Model
	private $_address = null; // 住所モデル

	private $_exif = array(); // Exif Data
	private $_latitude = array(); // 北緯
	private $_longitude = array(); // 東経
	private $_direction = null; // 方角
	private $_direction_image = null; // 方角画像

	function __construct()
	{
		$this->_log = new Logger(__CLASS__);
		$this->_log->pushHandler(new ChromePHPHandler());
	}

	/**
	 * EXIFの取得
	 *
	 * @return array
	 */
	/**
	 * @return mixed
	 */
	public function get_exif()
	{
		return $this->_exif;
	}

	/**
	 * 北緯の取得
	 *
	 * @return array
	 */
	/**
	 * @return mixed
	 */
	public function get_latitude()
	{
		return $this->_address->get_latitude();
	}

	/**
	 * 東経の取得
	 *
	 * @access  public
	 * @return  string
	 */
	/**
	 * @return array
	 */
	public function get_longitude()
	{
		return $this->_address->get_longitude();
	}

	/**
	 * 住所の取得
	 *
	 * @return mixed
	 */
	public function get_address()
	{
		// Model生成
		$this->_address = new Address();
		$this->_address->set_gps_latitude($this->_latitude);
		$this->_address->set_gps_longitude($this->_longitude);
		$this->_address->re_geocode();
		return $this->_address->get_address();
	}

	/**
	 * 方角画像の設定
	 *
	 * @param $value
	 */
	public function set_direction_image($value)
	{
		$this->_direction_image = $value;
	}

	/**
	 * 方角画像の取得
	 *
	 * @return null
	 */
	public function get_direction_image()
	{
		return $this->_direction_image;
	}

	/**
	 * Exifの読み込み
	 *
	 */
	public function read()
	{
		$this->_exif = @exif_read_data(parent::get_file_name_full(), 0, true);
		if (isset($this->_exif['GPS']['GPSLatitude']) && isset($this->_exif['GPS']['GPSLongitude'])) {
			$this->_latitude = $this->_exif['GPS']['GPSLatitude'];
			$this->_longitude = $this->_exif['GPS']['GPSLongitude'];
			isset($this->_exif['GPS']['GPSDestBearing']) ? $this->_direction = (int)$this->_exif['GPS']['GPSDestBearing'] : $this->_direction = null;
		}
	}

	/**
	 * サムネイルの生成
	 *
	 */
	public function thumbnail_create()
	{
		// EXIFのサムネイルを確認
		$image = exif_thumbnail($this->get_file_name_full(), $width, $height, $type);
		if (!$image) {
			// Exifのサムネイルが存在しない場合は元ファイルを使用する
			$image = file_get_contents($this->get_file_name_full());
		}
		// リサイズ
		$src = \imagecreatefromstring($image);
		// 縮小サイズを取得
		$width = imagesx($src);
		$height = imagesy($src);
		// 縦横比計算
		$aspect_ratio = $height / $width;
		// リサイズ計算
		if ($width <= self::THUMBNAIL_SIZE) {
			$new_w = $width;
			$new_h = $height;
		} else {
			if ($width > $height) {
				$new_h = self::THUMBNAIL_SIZE;
				$new_w = abs($new_h / $aspect_ratio);
			} else {
				$new_w = self::THUMBNAIL_SIZE;
				$new_h = abs($new_w * $aspect_ratio);
			}
		}
		// 新しいサイズの空画像を生成
		$new_img = imagecreatetruecolor($new_w, $new_h);
		if (ImageCopyResampled($new_img, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height)) {
			// Base64にエンコード
			$temp_file = tempnam(sys_get_temp_dir(), 'temp_img');
			imagepng($new_img, $temp_file);
			$handle = fopen($temp_file, "r");
			$contents = fread($handle, filesize($temp_file));
			fclose($handle);
			$encode_data = base64_encode($contents);
			$this->set_thumbnail('data:image/png;base64,'.$encode_data);
			// ファイル削除
			if (!unlink($temp_file)) {
				$error_message = 'ファイルの削除に失敗しました('.$temp_file.')。';
				$this->_log->addError($error_message);
			}
		};
		// メモリ解放
		imagedestroy($new_img);
		imagedestroy($src);
	}

	/**
	 * 方角画像の生成
	 *
	 */
	public function direction_image_create()
	{
		if (isset($this->_direction)) {
			// 方角あり
			$image = new \Imagick();
			$image->readImage(APPPATH.self::ARROW_IMAGE);
			$this->_log->addInfo(__METHOD__.' direction_image_create readImage:'.APPPATH.self::ARROW_IMAGE);
			$image->rotateImage('none', $this->_direction);
			$encode_data = base64_encode($image);
			$this->set_direction_image('data:image/png;base64,'.$encode_data);
		}
	}

}