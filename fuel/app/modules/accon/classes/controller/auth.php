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
 * Class Controller_Auth
 *
 * 認証コントロールクラス.
 */
class Controller_Auth extends Foundation\Controller_Accon implements Foundation\Interface_Auth
{
	// 認証・認可処理
	private $auth;
	// 画面生成オブジェクト
	protected $single_view_create;

	/**
	 * 前処理
	 *
	 * 自身のアクセス権限をチェック
	 */
	public function before()
	{
		parent::before();
		// 認証処理生成
		$class = \Config::get('accon.behavior.auth');
		$this->auth = new $class();
		// Viewの状態を設定
		Foundation\Behavior_View_Physical::before();
	}

	/**
	 * Viewセットの生成
	 *
	 * @param \view $view
	 * @return \Fuel\Core\View
	 */
	public function view_creator(\view $view) {
		return Foundation\Behavior_View::view_creator($view);
	}

	/**
	 * ログイン・アクション
	 *
	 * @return \Fuel\Core\View
	 */
	public function action_login()
	{
		// 初回呼び出し元を保存
		if (is_null(\Session::get('parent_request')) or \Input::referrer() != \Uri::current()) {
			\Session::set('parent_request', \Input::referrer());
		}
		$parent_request = \Session::get('parent_request', '/');
		// View生成 レイアウトビューを作成する
		$view = $this->view_creator(\View::forge(MODULE.'::/auth/login'));
		// Validationの取得
		$val = \Validation::forge();
		// 画面のパラメータ取得
		$input = array();
		if (\Input::method() == POST) {
			// 画面の値を全て設定
			$posts = \Input::post();
			foreach($posts as $key => $post) {
				// システムが使用しているPostプロパティを除外
				if ($key !== \Config::get('security.csrf_token_key') and $key !== PROCESSING and $key !== 'rows') {
					try {
						// 入力値
						$input[$key] = $post;
						// View設定
						$view->content->$key = $post;
						// Validation
						$val->add($key, $post)->add_rule('required');
					} catch (\OutOfBoundsException $e){}
				}
			}
		}
		try {
			// ログイン状態確認
			if ($this->check()) {
				// ログイン済みの場合、元のページに戻る
				\Response::redirect_back();
			}
			// Validation
			if ($val->run()) {
				$message = '';
				// ログイン状態設定
				\Session::set_flash('Logged', false);
				// 認証
				if ($this->login($input, $message)) {
					// 成功
//					\Response::redirect_back($parent_request, 'refresh', 200);
//                  \Response::redirect_back('/', 'refresh', 200);
                    \Response::redirect_back();
				} else {
					$view->content->login_error = $message;
				}
			}
			// Validation結果
			$view->content->val = $val;
			return $view;
		} catch (\Exception $e) {
			\Log::error(ERROR_SYSTEM_FAILURE_MESSAGE.','.$e->getMessage(), $this->request->controller.'::'.$this->request->action);
			\Session::set_flash('error', ERROR_SYSTEM_FAILURE_MESSAGE);
			\Response::redirect_back();
		}
	}

	/**
	 * ログアウト・アクション
	 */
	public function action_logout()
	{
		try {
			// ログアウト
			$this->logout();
		} catch (\Exception $e) {
			\Log::error(ERROR_SYSTEM_FAILURE_MESSAGE.','.$e->getMessage(), $this->request->controller.'::'.$this->request->action);
			\Session::set_flash('error', ERROR_SYSTEM_FAILURE_MESSAGE);
		} finally {
			// 元のページに戻る（ゲスト権限がない場合は、TOPエリアへ）
			\Response::redirect_back('/', 'refresh', 200);
		}
	}


	/**
	 * ログイン処理
	 *
	 * @param array $input
	 * @param string $message
	 * @return bool
	 */
	public function login($input = array(), &$message ='')
	{
		// 認証
		if ($this->auth->login($input, $message)) {
			// 成功
			\Session::delete('parent_request');
			// ログイン状態を保持
			\Session::set_flash('Logged', true);
			return true;
		} else {
			// 失敗
			\Log::info('login ng. id:' . $input['email'], $this->request->controller . '::' . $this->request->action);
			return false;
		}
	}

	/**
	 * ログイン状態確認
	 *
	 * @return bool
	 */
	public function check()
	{
		return $this->auth->check();
	}

	/**
	 * ログアウト処理
	 */
	public function logout()
	{
		// ログイン状態確認
		if ($this->check()) {
			// ログアウト
			$this->auth->logout();
			\Session::delete('parent_request');
		}
	}

}

