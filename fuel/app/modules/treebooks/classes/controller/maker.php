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

namespace Treebooks;

use \Accon\Foundation\Controller_Physical_Crud;
use Treebooks\Model\Contents;
use Treebooks\Model\Slug;
use Accon\Model\Permission;

/**
 * サービスコントローラー
 *
 */
class Controller_Maker extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'TreeBooks maker';
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
		$search_title = $this->search_input('title');
		$search_slug_id = $this->search_input('slug_id');
		$search_status = $this->search_input('status');
		$search_perms_id = $this->search_input('perms_id');
		// クエリーの取得
		$query = $this->get_query();
		$query->order_by('public_at', 'desc')
			  ->order_by('title', 'asc');
		// 検索条件
		$where = array(array('left_id', 1));
		if (!($search_title === '')) $where = array_merge($where, array(array('title', 'like', $search_title.'%')));
		if (!($search_slug_id === '')) $where = array_merge($where, array(array('slug_id', '=', $search_slug_id)));
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
		$view->val->add_field('slug_id', 'slug_id', 'required');
		$view->val->add_field('permission', 'Permission', 'required|max_length[25]');
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->slug_id = \Input::post('slug_id');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->content = \Input::post('content');
			$view->model->permission->permission = \Input::post('permission');
			$view->model->permission->description = $view->model->title;
			// Areaの設定
			$publishing_point = \Config::get('books.publishing_point');
			$slug = Slug::find($view->model->slug_id, array('select' => array('code')));
			$view->model->permission->area = mb_strtolower($publishing_point.'/'.$slug->code);
			$view->model->permission->actions = ACTION_ROOT.','.ACTION_INDEX.','.ACTION_VIEW;
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
		$view->val->add_field('slug_id', 'slug_id', 'required');
		$view->val->add_field('permission', 'Permission', 'required|max_length[25]');
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->slug_id = \Input::post('slug_id');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->content = \Input::post('content');
		}
		// 作成
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			$view->model->permission = Permission::forge();
			$view->model->permission->permission = \Input::post('permission');
			$view->model->permission->description = $view->model->title;
			// Areaの設定
			$publishing_point = \Config::get('treebooks.publishing_point');
			if (!empty($view->model->slug_id)) {
				$slug = Slug::find($view->model->slug_id, array('select' => array('code')));
				$view->model->permission->area = mb_strtolower($publishing_point.'/'.$slug->code);
			}
			$view->model->permission->actions = ACTION_ROOT.','.ACTION_INDEX.','.ACTION_VIEW;
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
		// Viewにフィルターのリストをセット
		$publishing_status = \Config::get('treebooks.published_status');
		$view->set_global('status', \Arr::assoc_to_keyval($publishing_status, 'key', 'val'));
		// アクセス権限を設定
		$view->set_permission('slug',$this->authority('/blog', 'slug', 'view'));
		$view->set_permission('permission',$this->authority('/accon/admin', 'permission', 'view'));
		// スラッグ選択用リスト
		$slug_list = \Arr::assoc_to_keyval(Slug::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('slug_list', array_flip(array_merge(array('' => ''), $slug_list)));
		// パーミッション用URLリスト
		$permission_list = Permission::get_urls();
		$view->set_global('permission_list', array_flip(array_merge(array('' => ''), $permission_list)));
		return $view;
	}

}