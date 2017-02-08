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

use Accon\Model\User_Permission;
use Accon\Model\Permission;
use Accon\Model\User;

/**
 * Class Controller_Admin_User_Permission
 *
 * ユーザとパーミッションを関連付けて権限を管理
 */
class Controller_Admin_User_Permission extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'ユーザ・パーミッション';
	// モデルクラス
	const MODEL = User_Permission::class;

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('user',$this->authority('/accon/admin', 'user', 'view'));
		$view->set_permission('permission',$this->authority('/accon/admin', 'permission', 'view'));
		// ユーザ選択用リスト
		$user_list = \Arr::assoc_to_keyval(User::find('all', array('order_by' => array('username' => 'asc'))), 'username', 'id');
		$view->set_global('user_list', array_flip(array_merge(array('' => ''), $user_list)));
		// パーミッション用URLリスト
		$permission_list = Permission::get_urls();
		$view->set_global('permission_list', array_flip(array_merge(array('' => ''), $permission_list)));
		return $view;
	}

}
