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
 * Interface Interface_Acl
 * @package Accon\Foundation
 */
interface Interface_Acl {
	/**
	 * アクセス権限チェック
	 */
	public function has_access();

	/**
	 * 実行権限チェック
	 *
	 * @param string $area
	 * @param string $permission
	 * @param string $action
	 * @return bool
	 */
	public function authority($area = '', $permission = '', $action = 'index');

	/**
	 * アクションの権限チェック
	 */
	public function authority_action();

}