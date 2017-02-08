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
 * Class Controller_Service_Crud
 *
 * CRUD基礎の振る舞いを提供するクラス.
 *  - C:作成(create)、R:一覧/照会(index/view)、U:変更(edit)、D:削除(delete)
 *  - パジネーション機能
 *  - 検索履歴機能
 *  - 更新ユーザの自動設定
 *  - エラー処理の共通化
 */
abstract class Controller_Physical_Crud extends Controller_Physical
{
	/**
	 * 前処理.
	 */
	public function before()
	{
		parent::before();
		// モデル操作生成
		$class = \Config::get('accon.behavior.physical.crud.operation.insert');
		$this->insert = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.crud.operation.update');
		$this->update = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.crud.operation.remove');
		$this->remove = new $class($this->get_model_class());
		// 画面生成
		$class = \Config::get('accon.behavior.physical.crud.view.list');
		$this->list_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.crud.view.single');
		$this->single_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.crud.view.update');
		$this->update_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.crud.view.insert');
		$this->insert_view_create = new $class($this->get_model_class());
	}

	/**********************************************************************************************
	 * The default implementation.
	 */

	/**
	 * 【Extending child element】index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// クエリーの取得
		$model = $this->get_model_class();
		$query = $model::query();
		// モデルへ値設定
		$where = array(); // 検索情景
		$order_by = array(); // ソート条件
		// 画面の値を取得
		$posts = \Input::post();
		if (count($posts) == 0 ) {
			// 画面からの値がない場合は、検索条件の復元
			$search = \Session::get(\Request::active()->controller.'.search');
			$posts = count($search) > 0 ? max($search) : array();
		}
		// 検索条件のパラメータを自動組み立て
		foreach(array_keys($posts) as $key) {
			// システムが使用しているPostプロパティを除外
			if ($key !== \Config::get('security.csrf_token_key') and $key !== PROCESSING and $key !== 'rows') {
				try {
					// 検索条件設定
					$post = self::search_input($key);
					// 検索条件を生成
					$where = array_merge($where, array(array($key, 'like', $post.'%')));
					// ソート条件を生成
					$order_by = array_merge($order_by, array(array($key, 'asc')));
				} catch (\OutOfBoundsException $e){}
			}
		}
		if ($where) $query->where($where);
		if ($order_by) $query->order_by($order_by);
		// viewの構築
		return $this->view_list($query);
	}

	/**
	 * 【Extending child element】view action.
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
	 * 【Extending child element】edit action.
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
			// 画面の値を全て設定
			$posts = \Input::post();
			foreach($posts as $key => $post) {
				// システムが使用しているPostプロパティを除外
				if ($key !== \Config::get('security.csrf_token_key') and $key !== PROCESSING and $key !== 'rows') {
					try {
						// モデルに値を設定
						$view->model->$key = $post;
					} catch (\OutOfBoundsException $e){}
				}
			}
		}
		return $view;
	}

	/**
	 * 【Extending child element】create action.
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
			// 画面の値を全て設定
			$posts = \Input::post();
			foreach($posts as $key => $post) {
				// システムが使用しているPostプロパティを除外
				if ($key !== \Config::get('security.csrf_token_key') and $key !== PROCESSING and $key !== 'rows') {
					try {
						// モデルに値を設定
						$view->model->$key = $post;
					} catch (\OutOfBoundsException $e){}
				}
			}
		}
		return $view;
	}

	/**
	 * 【Extending child element】delete action.
	 *
	 * @param null $id
	 */
	protected function delete($id = null)
	{
		// 削除
		$this->model_remove($id);
	}

}
