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

use Accon\Foundation\Controller_Kinetic_Nested;
use Treebooks\Model\Contents;

/**
 * サービスコントローラー
 *
 */
class Controller_Book extends Controller_Kinetic_Nested
{
	// モデルクラス
	const MODEL = Contents::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		$view = parent::index();
		$keyword = '';
		// SEO
		$title = $view->entry->title;
		foreach ($view->ancestors_list as $ancestors) {
			$keyword .= (empty($keyword) ? '' : ',') . mb_strimwidth($ancestors['title'], 0, 32, '...', 'UTF-8' );
		}
		$keyword .= (empty($keyword) ? '' : ',') . $title;
		$view->set_global('title', $title, true);
		$view->set_global('description',
			str_replace("\n", " ", mb_strimwidth(strip_tags(\Markdown::parse($view->entry->content)), 0, 256, '...', 'UTF-8' )), false);
		$view->set_global('keyword', $keyword, true);
		return $view;
	}

}