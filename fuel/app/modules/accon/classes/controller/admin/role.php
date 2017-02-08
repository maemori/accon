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

// Model
use Accon\Model\Role;

/**
 * Class Controller_Admin_Role
 */
class Controller_Admin_Role extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'ロール';
	// モデルクラス
	const MODEL = Role::class;


	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('group',$this->authority('/accon/admin', 'group', 'view'));
		$view->set_permission('user',$this->authority('/accon/admin', 'user', 'view'));
		// Viewにフィルターのリストをセット
		$view->set_global('filters', \Arr::assoc_to_keyval(\Config::get('accon.roll_authorization_list'), 'key', 'val'));
		return $view;
	}

}
