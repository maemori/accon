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

namespace Menus;

use Accon\Foundation\Controller_Physical_Crud;
use Menus\Model\Contents;
use Menus\Model\Menu;
use Accon\Model\Permission;

/**
 * サービスコントローラー
 *
 */
class Controller_Maker extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Menu maker';
	// モデルクラス
	const MODEL = Contents::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// 検索条件設定
		$search_title = parent::search_input('title');
		$search_status = parent::search_input('status');
		$search_perms_id = parent::search_input('perms_id');
		// クエリーの取得
		$query = $this->get_query();
		$query->related('menu')
			  ->order_by('menu.sort', 'asc')
			  ->order_by('public_at', 'desc')
			  ->order_by('title', 'asc');
		// 検索条件
		$where = array(array('left_id', 1));
		if (!($search_title === '')) $where = array_merge($where, array(array('title', 'like', $search_title.'%')));
		if (!($search_status === '')) $where = array_merge($where, array(array('status', '=', $search_status)));
		if (!($search_perms_id === '')) $where = array_merge($where, array(array('perms_id', '=', $search_perms_id)));
		if ($where) $query->where($where);
		// viewの構築
		return $this->view_list($query);
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
		// Validationの追加
		$view->val->add_field('permission', 'Permission', 'required|max_length[25]');
		// Validationの実行
		if ($view->val->run()) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->description = \Input::post('description');
			$view->model->permission->permission = \Input::post('permission');
			$view->model->permission->description = $view->model->title;
			$view->model->menu->sort = \Input::post('sort');
			$view->model->menu->top_display_flag = \Input::post('top_display_flag');
			// Areaの設定
			$publishing_point = \Config::get('menus.publishing_point');
			$view->model->permission->area = mb_strtolower($publishing_point);
			$view->model->permission->actions = ACTION_INDEX;
		}
		// Viewを返す
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
		// Validationの追加
		$view->val->add_field('permission', 'Permission', 'required|max_length[25]');
		// Validationの実行
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->description = \Input::post('description');
		}
		// 作成
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			$view->model->permission = Permission::forge();
			$view->model->menu = Menu::forge();
			$view->model->permission->permission = \Input::post('permission');
			$view->model->permission->description = $view->model->title;
			$view->model->menu->sort = \Input::post('sort');
			$view->model->menu->top_display_flag = \Input::post('top_display_flag');
			// Areaの設定
			$publishing_point = \Config::get('menus.publishing_point');
			$view->model->permission->area = mb_strtolower($publishing_point);
			$view->model->permission->actions = ACTION_INDEX;
		}
		// Viewを返す
		return $view;
	}

	/**
	 * delete action.
	 *
	 * @param null $id
	 */
	protected function delete($id = null)
	{
		// Modelの構築
		$model =  Contents::find($id);
		// 子のモデルが存在した場合削除不可
		if (!$model->is_leaf()) {
			\Session::set_flash('error', ERROR_CHILDREN_DELETE_MESSAGE.' ID:'.$id);
			\Response::redirect(\Session::get('return_url'));
		}
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
		$view->set_permission('permission',$this->authority('/accon/admin', 'permission', 'view'));
		// Viewにフィルターのリストをセット
		$publishing_status = \Config::get('menus.published_status');
		$view->set_global('status', \Arr::assoc_to_keyval($publishing_status, 'key', 'val'));
		// パーミッション用URLリスト
		$permission_list = Permission::get_urls();
		$view->set_global('permission_list', array_flip(array_merge(array('' => ''), $permission_list)));
		return $view;
	}

}