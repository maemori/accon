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

/**
 * 住所モデル
 *
 * 住所に関わる処理を行う.
 */
class Address extends \Model
{
	const RE_GEOCODE_SERVICE_URL = 'http://www.finds.jp/ws/rgeocode.php'; // 逆ジオコーディングサービスURL
	const RE_GEOCODE_SERVICE_PARAM_LAT = 'lat'; // 北緯パラメータ名
	const RE_GEOCODE_SERVICE_PARAM_LON = 'lon'; // 東経パラメータ名
	const FONT_PATH = '/usr/share/fonts/truetype/ArmedBanana/ArmedBanana.ttf'; // フォントのパス
	const FONT_SIZE = 18; //フォントサイズ

	private $_gps_latitude = array(); // GPS北緯
	private $_gps_longitude = array(); // GPS東経
	private $_latitude = ''; // 北緯（10進）
	private $_longitude = ''; // 東経（10進）
	private $_address = ''; // 住所
	private $_prefecture = ''; // 都道府県
	private $_municipality = ''; // 市区町村
	private $_section = ''; // 町丁目・字等
	private $_home_number = ''; // 番地等
	private $_aza = ''; // 町丁目・字
	private $_image = null; // 画像

	/**
	 * 住所を返す
	 *
	 * @return string
	 */
	public function get_address()
	{
		return $this->_address;
	}

	/**
	 * 北緯を返す（10進）
	 *
	 * @return string
	 */
	public function get_latitude()
	{
		return $this->_latitude;
	}

	/**
	 * 東経を返す（10進）
	 *
	 * @return string
	 */
	public function get_longitude()
	{
		return $this->_longitude;
	}

	/**
	 * 北緯設定（10進数）
	 *
	 * @param $values
	 */
	public function set_latitude($values)
	{
		$this->_latitude = $values;
	}

	/**
	 * 東経設定（10進数）
	 *
	 * @param $values
	 */
	public function set_longitude($values)
	{
		$this->_longitude = $values;
	}

	/**
	 * 北緯設定（60進数）
	 *
	 * @param $values
	 */
	public function set_gps_latitude($values)
	{
		$this->_gps_latitude = $values;
		$this->_latitude = self::convert_decimal($values);
	}

	/**
	 * 東経設定（60進数）
	 *
	 * @param $values
	 */
	public function set_gps_longitude($values)
	{
		$this->_gps_longitude = $values;
		$this->_longitude = self::convert_decimal($values);
	}

	/**
	 * 画像の設定
	 *
	 * @param $value
	 */
	public function set_image($value)
	{
		$this->_image = $value;
	}

	/**
	 * 画像の取得
	 *
	 * @return null
	 */
	public function get_image()
	{
		return $this->_image;
	}

	/**
	 * 逆ジオコーディング
	 *
	 * @throws \Exception
	 */
	public function re_geocode()
	{
		// 北緯東経が０位外実行
		if ($this->_latitude == 0 or $this->_longitude == 0) return;
		try {
			// 外部サービスから住所を取得
			$url = self::RE_GEOCODE_SERVICE_URL.'?'.
				self::RE_GEOCODE_SERVICE_PARAM_LAT.'='.$this->_latitude.'&'.
				self::RE_GEOCODE_SERVICE_PARAM_LON.'='.$this->_longitude;
			$data = simplexml_load_file($url);
			// ステータス確認
			if ($data->status != '200') throw new \HttpServerErrorException;
			// 取得住所の保存
			$this->set_address($data->result);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * 配列から住所情報を設定
	 *
	 * @param $values
	 */
	private function set_address($values)
	{
		$this->_prefecture = isset($values->prefecture->pname) ? (string)$values->prefecture->pname : '';
		$this->_municipality = isset($values->municipality->mname) ? (string)$values->municipality->mname : '';
		$this->_section = isset($values->local->section) ? (string)$values->local->section : '';
		$this->_home_number = isset($values->local->homenumber) ? (string)$values->local->homenumber : '';
		$this->_aza = isset($values->aza->name) ? (string)$values->aza->name : '';
		$this->_address = $this->_prefecture.$this->_municipality.$this->_section.$this->_home_number.$this->_aza;
	}

	/**
	 * 緯度・経度の、60進数表記（度・分・秒表記）から10進数表記へ変換
	 *
	 * @param $values
	 * @return float|int
	 */
	private static function convert_decimal($values)
	{
		$decimal = 0;
		if (isset($values[0]) and isset($values[1]) and isset($values[2])) {
			// 度
			$degrees = explode("/", $values[0]);
			$degrees = (double)$degrees[0] / (double)$degrees[1];
			// 分
			$minutes = explode("/", $values[1]);
			$minute = (double)$minutes[0] / (double)$minutes[1] / 60;
			// 秒
			$seconds = explode("/", $values[2]);
			$second = (double)$seconds[0] / (double)$seconds[1] / 3600;
			// 
			$decimal = $degrees + $minute + $second;
		}
		return $decimal;
	}

	/**
	 * 画像の生成
	 *
	 * @param $value
	 */
	public function image_create($value)
	{
		if (isset($value)) {
			$value = $value."\n".$this->_address;
		} else {
			$value = $this->_address;
		}
		$tx = 2; //最初の文字のX座標のベースポイント
		$ty = self::FONT_SIZE * 1.15; //フォントペースラインの位置
		$box = imagettfbbox(self::FONT_SIZE, 0, self::FONT_PATH, $value); // 大きさを測定
		$width = $box[2] - $box[6] + self::FONT_SIZE * 0.35 + 4; //幅の設定
		$height = $box[3] - $box[7] + 4; // 高さの設定
		$img = imagecreatetruecolor($width, $height);
		$font_color = imagecolorallocatealpha($img, 210, 0, 0, 255);
		$background_color = imagecolorallocatealpha($img, 255, 255, 255, 45);
		imagealphablending($img, true); // ブレンドモードを設定する
		imagesavealpha($img, true); // 完全なアルファチャネルを保存する
		imagefill($img, 0, 0, $background_color); // 指定座標から指定色で塗る
		imagefttext($img, self::FONT_SIZE, 0, $tx, $ty, $font_color, self::FONT_PATH, $value); //テキスト描画
		ob_start();
		imagepng($img);
		$string_data = ob_get_contents();
		ob_end_clean();
		$encode_data = base64_encode($string_data);
		$this->set_image('data:image/png;base64,'.$encode_data);
		imagedestroy($img);
	}

}