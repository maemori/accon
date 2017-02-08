<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 Maemori Fumihiro
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     Maemori Fumihiro
 * @link       https://kurobuta.jp
 */

namespace Accon;

/**
 * Class Library_Utility
 */
class Library_Utility
{
	/**
	 * 文字列を区切り文字で配列化
	 *
	 * @param string $str
	 * @return array
	 */
	public static function replace($str = ''){
		$delimiter = array(" ", ",", ".", "'", "\"", "|", "\\", "/", ";", ":");
		$replace = str_replace($delimiter, $delimiter[0], $str);
		$array = array_values(array_filter(explode($delimiter[0], $replace)));
		foreach ($array as $key => $value) {
			$array[$key] = trim($value);
		}
		return $array;
	}

	/**
	 * 文字列を区切り文字で分割しシリアライズする
	 *
	 * @param string $var
	 * @param bool $reverse true:keyとvalを反転
	 * @return string
	 */
	public static function serialize($var = '', $reverse = false)
	{
		if (empty($var)) return $var;
		$serialize_data = self::replace($var);
		if ($reverse) $serialize_data = array_flip($serialize_data);
		return serialize($serialize_data);
	}

	/**
	 * シリアライズされた文字列をカンマ区切りの文字列に変換
	 *
	 * @param string $var
	 * @param bool $reverse true:keyとvalを反転
	 * @return string
	 */
	public static function un_serialize($var = '', $reverse = false)
	{
		if (empty($var)) return $var;
		$un_serialize_data = unserialize(htmlspecialchars_decode($var));
		if ($reverse) $un_serialize_data = array_flip($un_serialize_data);
		foreach ($un_serialize_data as $key => $value) {
			$un_serialize_data[$key] = trim($value);
		}
		if (isset($un_serialize_data)) $var = implode(', ', $un_serialize_data);
		return $var;
	}

	/**
	 * 指定された文字数で文字列を後方から、その文字数だけ表示する
	 *
	 * @param $str
	 * @param $width
	 * @return string
	 */
	public static function omit_character_behind($str, $width, $trim_marker = '...')
	{
		if (strlen($str) >= $width){
			return $trim_marker.substr($str, (-1)*$width);
		}
		return $str;
	}

}