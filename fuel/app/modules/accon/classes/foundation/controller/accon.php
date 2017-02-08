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
 * Class Controller_Foundation_Core
 *
 * 基板コントローラークラス
 *  - ログイン/ログアウト機能
 *  - CSRF対策
 *  - Viewセットの生成
 */
abstract class Controller_Accon extends \Controller implements Interface_Acl
{
	protected $acl; // アクセス制御モジュール
	private $_module = ''; // Module名
	private $_base_url = ''; // URL

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
	 * ユーザID
	 *
	 * @return mixed
	 */
	public function get_user_id()
	{
		return $this->acl->get_user_id();
	}

	/**
	 * アクセスエリア
	 *
	 * @return string
	 */
	public function get_area_name()
	{
		return $this->acl->get_area_name();
	}

	/**
	 * アクセスエリア
	 *
	 * @return string
	 */
	public function set_area_name($area_name)
	{
		return $this->acl->set_area_name($area_name);
	}

	/**
	 * アクセスパーミッション
	 *
	 * @return string
	 */
	public function get_permission_name()
	{
		return $this->acl->get_permission_name();
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
	 * モジュール名（アプリケーション層の場合は空）
	 *
	 * @return string
	 */
	public function get_module()
	{
		return $this->_module;
	}

	/**
	 * 前処理
	 *
	 */
	public function before()
	{
		parent::before();
		// Logging
		\Log::debug('[START]', $this->request->controller.'::'.$this->request->action);
		// CSRF確認
		if ($_POST) {
			// CSRF トークンが正しいかチェック
			if (!\Security::check_token()) {
				// CSRF 攻撃または CSRF トークンの期限切れ
				\Log::error(ERROR_CSRF, $this->request->controller.'::'.$this->request->action);
				\Session::set_flash('error', ERROR_CSRF.' (REAL IP:'.\Input::real_ip().', IP:'.\Input::ip().')');
				\Response::redirect_back();
			}
		}
		// Module内外実行判別
		$this->_module = isset($this->request->module)? $this->request->module : '';
		// リクエストコントローラー名をURLに変換
		$class_name = explode('_', $this->request->controller);
		unset($class_name[0]);
		foreach ($class_name as $node) {
			$this->_base_url .= mb_strtolower($node).'/';
		}
		\Session::set('base_url', $this->_module.'/'.$this->_base_url);
	}

	/**
	 * 後処理
	 *
	 * @param $response
	 * @return \Fuel\Core\Response
	 */
	public function after($response)
	{
		// Logging
		\Log::debug('[END]', $this->request->controller.'::'.$this->request->action);
		$response = parent::after($response);
		return $response;
	}

}