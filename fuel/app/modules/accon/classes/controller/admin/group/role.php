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

use Accon\Model\Group_Role;
use Accon\Model\Group;
use Accon\Model\Role;

/**
 * Class Controller_Admin_Group_Role
 */
class Controller_Admin_Group_Role extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'グループ・ロール';
	// モデルクラス
	const MODEL = Group_Role::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// 検索条件設定
		$search_group_id = $this->search_input('group_id');
		$search_role_id = $this->search_input('role_id');
		// クエリーの取得
		$query = $this->get_query();
		$query->order_by('group_id', 'asc')
			  ->order_by('role_id', 'asc');
		// 検索条件
		$where = array();
		if (!($search_group_id === '')) $where = array_merge($where, array(array('group_id', '=', $search_group_id)));
		if (!($search_role_id === '')) $where = array_merge($where, array(array('role_id', '=', $search_role_id)));
		if ($where) $query->where($where);
		// viewの構築
		// viewの構築
		return parent::view_list($query);
	}

	/**
	 * view action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function view($id = null)
	{
		// viewの構築
		return $this->view_single($id);
	}

	/**
	 * edit action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function edit($id = null)
	{
		// viewの構築
		$view = $this->view_update($id);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->group_id = \Input::post('group_id');
			$view->model->role_id = \Input::post('role_id');
		}
		return $view;
	}

	/**
	 * create action.
	 *
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	protected function create()
	{
		// viewの構築
		$view = $this->view_insert();
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->group_id = \Input::post('group_id');
			$view->model->role_id = \Input::post('role_id');
		}
		return $view;
	}

	/**
	 * delete action.
	 *
	 * @param null $id
	 */
	protected function delete($id = null)
	{
		// 削除
		$this->model_remove($id);
	}

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		// アクセス権限を設定
		$view->set_permission('group',$this->authority('/accon/admin', 'group', 'view'));
		$view->set_permission('role',$this->authority('/accon/admin', 'role', 'view'));
		// グループ選択用リスト
		$group_list = \Arr::assoc_to_keyval(Group::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('group_list', array_flip(array_merge(array('' => ''), $group_list)));
		// ロールョン用リスト
		$role_list = \Arr::assoc_to_keyval(Role::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('role_list', array_flip(array_merge(array('' => ''), $role_list)));
		return $view;
	}

}
