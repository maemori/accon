<?php

use Model\Post;
use Model\Slug;

/**
 * Class Controller_Blog_Post
 */
class Controller_Blog_Post extends \Accon\Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Post';
	// モデルクラス
	const MODEL = Post::class;

	// 公開ステータスリスト
	private static $_status = array(
		array(
			'key' => '',
			'val' => '',
		),
		array(
			'key' => 'public',
			'val' => '公開',
		),
		array(
			'key' => 'close',
			'val' => '非公開',
		),
	);

	/**
	 * view描写前補完
	 *
	 * @param View $view
	 * @return View
	 */
	protected function view_after(\View $view = null){
		// Viewにフィルターのリストをセット
		$view->set_global('status', \Arr::assoc_to_keyval(self::$_status, 'key', 'val'));
		// アクセス権限を設定
		$view->set_permission('slug',$this->authority('/blog', 'slug', 'view'));
		// スラッグ選択用リスト
		$slug_list = \Arr::assoc_to_keyval(Slug::find('all', array('order_by' => array('name' => 'asc'))), 'name', 'id');
		$view->set_global('slug_list', array_flip(array_merge(array('' => ''), $slug_list)));
		return $view;
	}

}
