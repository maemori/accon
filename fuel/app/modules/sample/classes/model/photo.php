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
 * 画像モデル
 *
 * 画像に関わる処理を行う.
 */
class Photo extends \Model
{
	private $_pass_name = ''; // ファイルパス
	private $_file_name = ''; // ファイル名
	private $_thumbnail = null; // サムネイル

	/**
	 * ファイルパス設定
	 *
	 * @param $value
	 */
	public function set_pass_name($value)
	{
		$this->_pass_name = $value;
	}

	/**
	 * ファイル名設定
	 *
	 * @param $value
	 */
	public function set_file_name($value)
	{
		$this->_file_name = $value;
	}

	/**
	 * ファイル名の取得
	 *
	 * @return string
	 */
	public function get_file_name()
	{
		return $this->_file_name;
	}

	/**
	 * パス・ファイル名の取得
	 *
	 * @return string
	 */
	public function get_file_name_full()
	{
		return $this->_pass_name.$this->_file_name;
	}

	/**
	 * サムネイルの設定
	 *
	 * @param $value
	 */
	public function set_thumbnail($value)
	{
		$this->_thumbnail = $value;
	}

	/**
	 * サムネイルの取得
	 *
	 * @return null
	 */
	public function get_thumbnail()
	{
		return $this->_thumbnail;
	}

}