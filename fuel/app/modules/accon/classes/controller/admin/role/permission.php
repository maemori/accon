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

use Accon\Model\Role_Permission;
use Accon\Model\Role;
use Accon\Model\Permission;

/**
 * Class Controller_Admin_Role_Permission
 */
class Controller_Admin_Role_Permission extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'ロール・パーミッション';
	// モデルクラス
	const MODEL = Role_Permission::class;

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('role',$this->authority('/accon/admin', 'role', 'view'));
		$view->set_permission('permission',$this->authority('/accon/admin', 'permission', 'view'));
		// ロール選択用リスト
		$role_list = \Arr::assoc_to_keyval(Role::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('role_list', array_flip(array_merge(array('' => ''), $role_list)));
		// パーミッション用URLリスト
		$permission_list = Permission::get_urls();
		$view->set_global('permission_list', array_flip(array_merge(array('' => ''), $permission_list)));
		return $view;
	}

}
