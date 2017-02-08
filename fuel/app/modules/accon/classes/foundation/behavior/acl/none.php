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
 * Class Behavior_Acl_None
 *
 * アクセス制御なし.（スタブ）
 */
class Behavior_Acl_None extends Behavior_Acl implements Interface_Acl
{
	/**
	 * アクセス権限をチェック
	 */
	public function has_access()
	{
		return true;
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
		return true;
	}

	/**
	 * アクションの実行権限チェック
	 *
	 * @param string $action
	 * @return bool
	 */
	public function authority_action($action = 'index')
	{
		return true;
	}

}