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
 * Class Behavior_Auth_None
 *
 * 認証なし.（スタブ）
 */
class Behavior_Auth_None implements Interface_Auth
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
		\Session::set('username', 'Auth None');
		return true;
	}

	/**
	 * ログイン状態確認
	 *
	 * @return bool
	 */
	public function check()
	{
		return true;
	}

	/**
	 * ログアウト
	 */
	public function logout()
	{
		\Session::delete('username');
	}

}
