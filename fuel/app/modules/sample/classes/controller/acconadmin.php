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

namespace Sample;

/**
 * サンプルコードのコントローラー
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Acconadmin extends \Controller
{
	// サービスの説明
	const SERVICE_TITLE = 'Accon管理機能実装方法';
	const SERVICE_SUB_TITLE = 'ブログ(管理)';
	const SERVICE_DESCRIPTION = 'Acconモジュールを利用したブログ(管理)の実装例。';
	const SERVICE_KEYWORD = 'php,fuelphp,accon,blog,front';

	/**
	 * コードサンプルの表示
	 *
	 * @return \Fuel\Core\View
	 */
	public function action_index()
	{
		// View生成 レイアウトビューを作成する
		$view = \View::forge('layout');
		// 画面の説明を設定
		$view->set_global('title', self::SERVICE_TITLE);
		$view->set_global('sub_title', self::SERVICE_SUB_TITLE);
		$view->set_global('description', self::SERVICE_DESCRIPTION, false);
		$view->set_global('keyword', self::SERVICE_KEYWORD);
		//View生成 変数としてビューを割り当てる、遅延レンダリング
		$view->head = \View::forge('head');
		$view->header = \View::forge('header');
		$view->top = \View::forge('top');
		$view->content = \View::forge('acconadmin/content');
		$view->footer = \View::forge('footer');
		return $view;
	}

}
