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

use Accon\Model\User_Role;
use Accon\Model\User;
use Accon\Model\Role;

/**
 * Class Controller_Admin_User_Role
 *
 * ユーザとロールを関連付けて権限を管理
 */
class Controller_Admin_User_Role extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'ユーザ・ロール';
	// モデルクラス
	const MODEL = User_Role::class;

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('user',$this->authority('/accon/admin', 'user', 'view'));
		$view->set_permission('role',$this->authority('/accon/admin', 'role', 'view'));
		// ユーザ選択用リスト
		$user_list = \Arr::assoc_to_keyval(User::find('all', array('order_by' => array('username' => 'asc'))), 'username', 'id');
		$view->set_global('user_list', array_flip(array_merge(array('' => ''), $user_list)));
		// ロールョン用リスト
		$role_list = \Arr::assoc_to_keyval(Role::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('role_list', array_flip(array_merge(array('' => ''), $role_list)));
		return $view;
	}

}
