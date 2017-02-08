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

use Accon\Model\Permission;

/**
 * Class Controller_Admin_Permission
 */
class Controller_Admin_Permission extends Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'パーミッション';
	// モデルクラス
	const MODEL = Permission::class;

	/**
	 * index action.
	 *
	 * @return \Fuel\Core\View
	 */
	protected function index()
	{
		// 検索条件設定
		$search_area = $this->search_input('area');
		$search_permission = $this->search_input('permission');
		// クエリーの取得
		$query = $this->get_query();
		$query->where(array('area', 'like', $search_area.'%'))
			  ->where(array('permission', 'like', $search_permission.'%'))
			  ->order_by('area', 'asc')
			  ->order_by('permission', 'asc');
		// viewの構築
		return $this->view_list($query);
	}

}
