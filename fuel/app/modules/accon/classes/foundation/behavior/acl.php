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

// 認証
use \Auth\Auth;

abstract class Behavior_Acl
{
	// コントローラサフィックス
	const CONTROLLER = 'Controller';
	const SUFFIX = '_';

	// コントローラ名
	private $_controller_name = null;
	// エリア名
	private $_area_name = null;
	// クラス名
	private $_permission_name = null;
	// アクション名
	private $_action_name = null;


	public function get_controller_name()
	{
		return $this->_controller_name;
	}

	/**
	 * @return int ユーザID
	 */
	public function get_user_id()
	{
		$user = Auth::get_user();
		return $user ? $user->id : 0;
	}

	/**
	 * @return string エリア名
	 */
	public function get_area_name()
	{
		return $this->_area_name;
	}

	/**
	 * @param null|string エリア名
	 */
	public function set_area_name($area_name)
	{
		$this->_area_name = $area_name;
	}

	/**
	 * @return string クラス名
	 */
	public function get_permission_name ()
	{
		return $this->_permission_name ;
	}

	/**
	 * @param null|string クラス名
	 */
	public function set_permission_name($class_name)
	{
		$this->_permission_name = $class_name;
	}

	/**
	 * @return string アクション名
	 */
	public function get_action_name()
	{
		return $this->_action_name;
	}

	/**
	 * @param null|string アクション名
	 */
	public function set_action_name($action_name)
	{
		$this->_action_name = $action_name;
	}

	/**
	 * @param null|string アクション名
	 */
	public function set_request($request)
	{
		$this->_controller_name = $request->controller;
		// コントローラ名を取得
		$this->_permission_name = explode('_', $request->controller);
		$this->_permission_name = mb_strtolower(end($this->_permission_name));
		// エリア名を取得
		$this->_area_name = substr($request->controller, 0, (mb_strlen($this->_permission_name) + 1) * -1);
		$this->_area_name = str_replace(self::CONTROLLER.self::SUFFIX, '', $this->_area_name);
		// エリア名を補完
		$vowels = array(self::CONTROLLER, self::SUFFIX, '\\');
		$this->_area_name = str_replace($vowels, DS, $this->_area_name);
		$this->_area_name = mb_strtolower(str_replace('//', '', $this->_area_name));
		if (substr($this->_area_name, 0, 1) != DS) $this->_area_name = DS.$this->_area_name;
		// アクション名を取得
		$this->_action_name = mb_strtolower($request->action);
	}

	/**
	 * アクセス権限チェック
	 *
	 * @return bool
	 */
	public function has_access()
	{
		// アクション名がlogin/logoutの場合リターン
		if ($this->_controller_name == TOP_CONTROLLER or $this->_action_name == 'login' or $this->_action_name == 'logout') return true;
		try {
			// アクセス権限チェック
			$access = Auth::has_access($this->_area_name.'.'.$this->_permission_name.'['.$this->_action_name.']');
			if ($access === false) {
				// 権限なし
				\Log::warning(ERROR_UNAUTHORIZED_MESSAGE, $this->_controller_name.'::'.$this->_action_name);
				return false;
			}
			return $access;
		} catch (\Exception $e) {
			\Log::error(ERROR_SYSTEM_FAILURE_MESSAGE, $this->_controller_name.'::'.$this->_action_name);
			return false;
		}
	}

	/**
	 * 実行権限チェック
	 *
	 * @param string $area
	 * @param string $permission
	 * @param string $action
	 * @return bool
	 */
	public function authority($area = '', $permission = '', $action = 'index')
	{
		// エリア名指定
		$this->set_area_name($area);
		// パーミッション名指定
		$this->set_permission_name($permission);
		// アクション名指定
		$this->set_action_name($action);
		// アクセス権限チェック
		return self::has_access();
	}

	/**
	 * アクションの実行権限チェック
	 *
	 * @param string $action
	 * @return bool
	 */
	public function authority_action($action = 'index')
	{
		// アクション名指定
		$this->set_action_name($action);
		// アクセス権限チェック
		return self::has_access();
	}

}