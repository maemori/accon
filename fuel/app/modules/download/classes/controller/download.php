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

namespace Download;

use Accon\Foundation\Controller_Physical_Crud;
use Download\Model\Download;

/**
 * サービスコントローラー
 *
 */
class Controller_Download extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Download now!';
	const SERVICE_SUB_TITLE = 'kurobuta.jp';
	const SERVICE_DESCRIPTION = 'ダウンロード公開ポイント';
	const SERVICE_KEYWORD = 'php,fuelphp,kurobuta.jp';
	// モデルクラス
	const MODEL = Download::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// 戻り先設定
		// Postクエリーの取得
		$query = Download::query()
			->where('status', '=', 'public')
			->where('public_at', '<=', time())
			->order_by('public_at', 'desc')
			->order_by('pass', 'asc')
			->order_by('name', 'asc');
		// viewの構築
		return $this->view_list($query, true);
	}

	/**
	 * view action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function view($id = null)
	{
		$entry = Download::find('first', array(
			'where' => array(array('id', '=', $id )),
		));
		$entry->impressions++;
		$entry->public_at = strtotime($entry->public_at);
		$entry->save();
		// viewの構築
		$view = $this->view_single($id, false);
		// SEO
		$view->set_global('title', $view->model->title, true);
		$view->set_global('description',
			str_replace("\n", " ", mb_strimwidth(strip_tags($view->model->description), 0, 256, '...', 'UTF-8' )), false);
		$view->set_global('keyword', 'Download （ダウンロード） '.$view->model->title, true);
		return $view;
	}

	/**
	 * get action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	public function action_get($id = null)
	{
		$entry = Download::find('first', array(
			'where' => array(array('id', '=', $id)),
		));
		$entry->get_number++;
		$entry->public_at = strtotime($entry->public_at);
		$entry->save();
		if (file_exists($entry['pass'].$entry['saved_as'])) {
			\File::download($entry['pass'].$entry['saved_as'], $entry['name']);
		}
		\Response::redirect();
	}

}