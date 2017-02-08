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

use Accon\Model\Permission;

/**
 * Class Controller_Foundation_Nested
 *
 * 再帰的な入れ子構造のモデルの振る舞いを提供するクラス.（Front用）
 */
abstract class Controller_Kinetic_Nested extends Controller_Kinetic
{
	/**
	 * 前処理.
	 */
	public function before()
	{
		parent::before();
		// 画面生成
		$class = \Config::get('accon.behavior.kinetic.nested.view.list');
		$this->list_view_create = new $class($this->get_model_class());
	}

	/**
	 * root action
	 *
	 * @return null
	 */
	public function action_root()
	{
		// Classの設定
		$class = $this->get_model_class();
		// rootからindexへ
		$permission = Permission::find('first',
			array('where' => array(
				array('area', $this->get_area_name()),
				array('permission', $this->get_permission_name()),
			),));
		if ($permission) {
			$contents = $class::find('first',
				array('where' => array(
					array('perms_id', $permission->id),
					array('left_id', 1),
				),
				));
			\Session::set('parent_id', $contents->id);
		}
		return $this->action_index();
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
		// ID設定
		$id = \Input::get('id');
		if (is_null($id)) $id = \Session::get('parent_id');
		\Session::set('parent_id', $id);
		// viewの構築
		return $this->view_list($id);
	}

}
