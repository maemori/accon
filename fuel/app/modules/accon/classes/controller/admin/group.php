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

use Accon\Model\Group;

/**
 * Class Controller_Admin_Group
 */
class Controller_Admin_Group extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'グループ';
	// モデルクラス
	const MODEL = Group::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// 検索条件設定
		$search_name = $this->search_input('name');
		// クエリーの取得
		$query = $this->get_query();
		$query->where(array('name', 'like', $search_name.'%'))
		      ->order_by('name', 'asc');
		// viewの構築
		return $this->view_list($query);
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
			$view->model->name = \Input::post('name');
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
			$view->model->name = \Input::post('name');
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
		// IDが0の場合、システムで使用しているため削除不可
		if ($id == 1){
			\Session::set_flash('error', ERROR_NOT_REMOVED_USED_SYSTEM.' ID:'.$id);
			\Response::redirect(\Session::get('return_url'));
		};
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
		return $view;
	}

}
