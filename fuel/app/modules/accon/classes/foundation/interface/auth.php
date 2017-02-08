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
 * Interface Interface_Auth
 * @package Accon\Foundation
 */
interface Interface_Auth {
	/**
	 * ログイン
	 *
	 * @param array $input
	 * @param string $message
	 * @return mixed
	 */
	public function login($input = array(), &$message ='');

	/**
	 * ログイン状態確認
	 *
	 * @return bool
	 */
	public function check();

	/**
	 * ログアウト
	 */
	public function logout();

}