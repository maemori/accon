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

/**
 * Class Behavior_Auth_Simple
 *
 * 認証.
 */
class Behavior_Auth_Simple implements Interface_Auth
{
	/**
	 * ログイン
	 *
	 * @param array $input
	 * @param string $message
	 * @return bool
	 */
	public function login($input = array(), &$message ='')
	{
		if (Auth::instance()->login($input['email'], $input['password'])) {
			// 成功
			\Session::set('username', Auth::get_screen_name());
			return true;
		} else {
			$message = 'アカウントもしくはパスワードが正しくありません';
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
		return Auth::check();
	}

	/**
	 * ログアウト
	 */
	public function logout()
	{
		Auth::logout();
		\Session::delete('username');
	}

}
