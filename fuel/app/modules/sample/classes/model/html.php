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
 * HTMLモデル
 *
 * HTMLに関わる処理を行う.
 */
class Html extends \Model
{
	private $_url = ''; // url
	private $_html = ''; // html

	/**
	 * HTMLの設定
	 *
	 * @param $value
	 */
	public function set_html($value)
	{
		$this->_html = $value;
	}

	/**
	 * HTMLの取得
	 *
	 * @return string
	 */
	public function get_html()
	{
		return $this->_html;
	}

	/**
	 * URLの設定
	 *
	 * @param $value
	 */
	public function set_url($value)
	{
		$this->_url = $value;
	}

	/**
	 * URLの取得
	 *
	 * @return string
	 */
	public function get_url()
	{
		return $this->_html;
	}

	/**
	 * URLから画像のパスを取得
	 *
	 * @return array
	 */
	public function get_images_file_pass()
	{
		$files = array();

		// HTMLの取得
		$this->_html = file_get_contents($this->_url);
		// 改行スペース除去
		$html = preg_replace('/\n|\r|\r\n|\t|\s/', '', $this->_html);
		// 画像タグ抽出
		preg_match_all('/<img(.+?)>/', $html, $img_tag_list);
		foreach ($img_tag_list[1] as $node) {
			// 画像パス抽出
			$node = preg_replace('/src=|\"|\'/', '', $node);
			// 定義された拡張子のみ処理の対象
			$extensions = str_getcsv(IMAGE_EXTENSIONS);
			foreach ($extensions as $extension) {
				preg_match_all('/(.+?)'.$extension.'/', $node, $img_pass_splint);
				if (isset($img_pass_splint[0][0])) $img_pass = $img_pass_splint[0][0];
			}
			if (isset($img_pass)) {
				// パスにドメインがない場合はURLを保管
				if (substr($img_pass, 0, 1) == '/') $img_pass = $this->_url.$img_pass;
				// パスとファイル名分割
				$path_parts = pathinfo($img_pass);
				// パスとファイルを保存
				array_push($files,
					array(
						'pass_name' => $path_parts['dirname'].'/',
						'file_name' => $path_parts['basename'],
					)
				);
			}
		}
		return $files;
	}

}