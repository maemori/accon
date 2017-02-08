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
 * Class Controller_Accon_Rest
 *
 * Restコントローラー.
 *  - 実行時に権限のチェック
 *  - ルーティング
 */
abstract class Controller_Accon_Rest extends \Controller_Rest implements Interface_Acl
{
	const CONTROLLER_PREFIX = 'Controller_';

	protected $acl; // アクセス制御モジュール

	/**
	 * 前処理
	 *
	 */
	public function before()
	{
		parent::before();
		// 認可処理生成
		$class = \Config::get('accon.behavior.rest.acl');
		$this->acl = new $class;
	}

	/**
	 * ユーザID
	 *
	 * @return mixed
	 */
	public function get_user_id()
	{
		return $this->acl->get_user_id();
	}

	/**
	 * アクセス権限チェック
	 */
	public function has_access(){
		return $this->acl->has_access();
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
		// アクセス権限チェック
		return $this->acl->authority($area, $permission, $action);
	}

	/**
	 * アクションの実行権限チェック
	 *
	 * @param string $action
	 * @return mixed
	 */
	public function authority_action($action = 'index')
	{
		// アクション名指定してアクセス権限チェック
		return $this->acl->authority_action($action);
	}

	/**
	 * Router
	 *
	 * Requests are not made to methods directly The request will be for an "object".
	 * this simply maps the object and method to the correct Controller method.
	 *
	 * @param $resource
	 * @param $arguments
	 * @return mixed|void
	 */
	public function router($resource, $arguments)
	{
		// If no (or an invalid) format is given, auto detect the format
		if (is_null($this->format) or ! array_key_exists($this->format, $this->_supported_formats)) {
			// auto-detect the format
			$this->format = array_key_exists(\Input::extension(), $this->_supported_formats) ? \Input::extension() : $this->_detect_format();
		}
		// アクセス権限チェック
		if($this->has_access()) {
			// If they call user, go to $this->post_user();
			$controller_method = strtolower(\Input::method()) . '_' . $resource;
			// Fall back to action_ if no rest method is provided
			if ( ! method_exists($this, $controller_method)) {
				$controller_method = 'action_'.$resource;
			}
			// If method is not available, set status code to 404
			if (method_exists($this, $controller_method)) {
				return call_fuel_func_array(array($this, $controller_method), $arguments);
			} else {
				$this->response->status = $this->no_method_status;
//				return;
			}
		} else {
			$this->response(array('status'=> 0, 'error'=> ERROR_UNAUTHORIZED_MESSAGE), 401);
		}
	}

}
