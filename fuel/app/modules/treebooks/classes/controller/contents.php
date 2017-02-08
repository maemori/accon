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

use Accon\Foundation\Controller_Physical_Nested;
use Treebooks\Model\Contents;
use Treebooks\Model\Slug;

/**
 * サービスコントローラー
 *
 */
class Controller_Contents extends Controller_Physical_Nested
{
	// サービスの説明
	const SERVICE_TITLE = 'Contents';
	// モデルクラス
	const MODEL = Contents::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// ID設定
		$id = \Input::get('id');
		if (is_null($id)) $id = \Session::get('parent_id');
		\Session::set('parent_id',$id);
		// viewの構築
		return $this->view_list($id);
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
		return $this->view_single($id,false);
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
		$view = $this->view_update($id, false);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->content = \Input::post('content');
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
		$view = $this->view_insert(false);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->content = \Input::post('content');
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
		$view->set_permission('slug',$this->authority('/treebooks', 'slug', 'view'));
		// Viewにフィルターのリストをセット
		$publishing_status = \Config::get('treebooks.published_status');
		$view->set_global('status', \Arr::assoc_to_keyval($publishing_status, 'key', 'val'));
		// スラッグ選択用リスト
		$slug_list = \Arr::assoc_to_keyval(Slug::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('slug_list', array_flip(array_merge(array('' => ''), $slug_list)));
		return $view;
	}

}