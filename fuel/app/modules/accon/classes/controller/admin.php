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

/**
 * 管理サービスコントローラー
 *
 */
class Controller_Admin extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Accon';
	const SERVICE_SUB_TITLE = 'Accon 管理メニュー';
	const SERVICE_DESCRIPTION = '基盤制御機能管理';
	const SERVICE_KEYWORD = 'php,fuelphp,kurobuta.jp,管理';

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	public function index()
	{
		// Viewの生成
		return $this->view_creator(\View::forge(MODULE.'::admin/content'));
	}

}
