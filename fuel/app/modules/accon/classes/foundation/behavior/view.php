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

namespace Accon\Foundation;

/**
 * Class Behavior_View
 *
 * @package Accon\Foundation
 */
abstract class Behavior_View
{
	// 基準モデルクラス
	private $_model_class;
	// Module名
	private $_module = '';
	// URL
	private $_base_url = '';

	/**
	 * コンストラクタ
	 *
	 * @param $model
	 */
	function __construct($model)
	{
		// Modelクラスを保持
		$this->_model_class = $model;
		// Module内外実行判別
		$this->_module = isset(\Request::active()->module)? \Request::active()->module : '';
		// リクエストコントローラー名をURLに変換
		$class_name = explode('_', \Request::active()->controller);
		unset($class_name[0]);
		foreach ($class_name as $node) {
			$this->_base_url .= mb_strtolower($node).'/';
		}
	}

	/**
	 * 基準モデルクラスの取得
	 *
	 * @return null
	 */
	final protected function get_model_class()
	{
		return $this->_model_class;
	}

	/**
	 * モジュール名（アプリケーション層の場合は空）
	 *
	 * @return string
	 */
	public function get_module()
	{
		return $this->_module;
	}

	/**
	 * Method
	 *
	 * @return int
	 */
	final protected function get_method_name()
	{
		return\Request::main()->controller.'::'.\Request::main()->action;
	}

	/**
	 * URL
	 *
	 * @return string
	 */
	public function get_base_url()
	{
		return $this->_base_url;
	}

	/**
	 * User Id
	 *
	 * @return int
	 */
	final protected function get_user_id()
	{
		return ($user_id = \Auth::get_user_id()) ? $user_id[1] : 0;
	}

	/**
	 * Viewセットの生成
	 *
	 * @param $content
	 * @param bool $top_area true=TOPエリア表示, false=TOPエリア非表示
	 * @return \Fuel\Core\View
	 */
	public static function view_creator($content, $top_area = false)
	{
		// View生成 変数としてビューを割り当てる、遅延レンダリング
		$view = \View::forge('layout/layout');
		$view->head = \View::forge('layout/head');
		$view->header = \View::forge('layout/header');
		if ($top_area) $view->top = \View::forge('layout/top');
		$view->content = $content;
		$view->content->val = null;
		$view->footer = \View::forge('layout/footer');
		return $view;
	}

}