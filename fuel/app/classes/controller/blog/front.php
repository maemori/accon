<?php

use Model\Post;
use Model\Slug;

/**
 * Class Controller_Welcome
 */
class Controller_Blog_Front extends \Accon\Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Blog!';
	const SERVICE_SUB_TITLE = 'WebでLogる';
	const SERVICE_DESCRIPTION = 'Blog兼Acconを利用した実装サンプル';
	const SERVICE_KEYWORD = 'php,fuelphp,sample,kurobuta.jp';
	// モデルクラス
	const MODEL = Post::class;

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
		// クエリーの取得
		$query = $this->get_query();
		$query->where('post_status', '=', 'public')
			  ->where('public_at', '<=', time())
			  ->order_by('public_at', 'desc')
			  ->order_by('title', 'asc');
		// 検索条件
		$where = array();
		if (!($search_title === '')) $where = array_merge($where, array(array('title', 'like', $search_title.'%')));
		if (!($search_slug_id === '')) $where = array_merge($where, array(array('slug_id', '=', $search_slug_id)));
		if ($where) $query->where($where);
		// viewの構築（TOPエリア表示）
		return $this->view_list($query, true);
	}

	/**
	 * view描写前補完
	 *
	 * @param View $view
	 * @return View
	 */
	protected function view_after(\View $view = null){
		// スラッグ選択用リスト
		$slug_list = \Arr::assoc_to_keyval(Slug::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		// Viewにリストを設定
		$view->set_global('slug_list', array_flip(array_merge(array('' => ''), $slug_list)));
		return $view;
	}
}
