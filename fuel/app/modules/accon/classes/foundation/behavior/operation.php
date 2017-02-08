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
 * Class Behavior_Operation
 *
 * Behavior : Index(Search) / View / Create / Update / Delete
 * @package Accon\Foundation
 */
abstract class Behavior_Operation
{
	// 基準モデルクラス
	private $_model_class;

	function __construct($model)
	{
		$this->set_model_class($model);
	}

	/**
	 * 基準モデルクラスの設定
	 *
	 * モデルオブジェクト生成時に使用
	 * @param $model_class
	 */
	final protected function set_model_class($model_class)
	{
		$this->_model_class = $model_class;
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
	 * Method
	 *
	 * @return int
	 */
	final protected function get_method_name()
	{
		return\Request::main()->controller.'::'.\Request::main()->action;
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

}