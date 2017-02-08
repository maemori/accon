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

// Model
use Accon\Model\Permission;

/**
 * Class Controller_Ajax_Auth_User_Permission
 */
class Controller_Ajax_Admin_Permission extends Foundation\Controller_Accon_Rest
{
	/**
	 * パーミッション取得
	 *
	 * @return mixed|object
	 */
	public function post_action()
	{
		$key = \Input::post('key');
		// クエリーの取得
		$query = Permission::query()
			->where(array('id', $key));
		// モデル取得
		$model = $query->get_one();
		$res = $model->actions;
		$res = $this->response($res, 200);
		return $res;
	}

	/**
	 * パーミッションリスト取得
	 *
	 * @return object
	 */
	public function post_permissions()
	{
		$key = \Input::post('key');
		// クエリーの取得
		$query = Permission::query()
			->where(array('area', $key))
			->order_by('permission', 'asc');
		// モデル取得
		$model = $query->get();
		// パーミッション・エリア選択用のモデルをViewにセット
		$perms_permission_list = \Arr::assoc_to_keyval($model, 'id', 'permission');
		$res = $this->response($perms_permission_list, 200);
		return $res;
	}

}
