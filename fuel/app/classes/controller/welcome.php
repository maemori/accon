<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 kurobuta.jp Development Team
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     kurobuta.jp Development Team
 * @link       https://kurobuta.jp
 */

use Accon\Foundation\Controller_Physical_Crud;
use Model\Post;
use Model\Slug;

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */

/**
 * Class Controller_Welcome
 */
class Controller_Welcome extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Welcome!';
	const SERVICE_SUB_TITLE = 'Sample System';
	const SERVICE_DESCRIPTION = ' ACCON実装サンプル';
	const SERVICE_KEYWORD = 'php,fuelphp,sample,kurobuta.jp';

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// Slug検索
		$entry = Slug::find('first', array(
			'select' => array('id', 'name'),
			'where' => array(array('name', '=', 'News')),
		));
		// Postクエリーの取得
		$query = Post::query()
			->where('slug_id', '=', isset($entry->id) ? $entry->id : 0)
			->where('post_status', '=', 'public')
			->where('public_at', '<=', time())
			->order_by('public_at', 'desc')
			->order_by('title', 'asc');
		// viewの構築
		$view = parent::view_list($query, true);
		// Viewを返す
		return $view;
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		// Viewの生成
		$view = $this->view_creator(View::forge('welcome/404'));
		$messages = array('あう、それないよ!', 'こんちくしょう!', 'あぁぁぁ!', 'ない、ないよ！ないよー', 'なに?なに?なに?');
		$view->content->title = $messages[array_rand($messages)];
		return $view;
	}

}
