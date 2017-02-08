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

namespace Accon\Model;

use Accon\Foundation\Model_Crud;

/**
 * Class Users_Group_Permission
 * @package Model\Service\Admin
 */
class User_Permission extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users_user_permissions';

	/**
	 * belongs to relationships
	 *
	 * @var array
	 */
	protected static $_belongs_to = array(
		'user' => array(
			'key_from' => 'user_id',
			'model_to' => '\Accon\Model\User',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'permission' => array(
			'key_from' => 'perms_id',
			'model_to' => '\Accon\Model\Permission',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

	/**
	 * validate
	 *
	 * @param $factory
	 * @return \Fuel\Core\Validation
	 */
	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('perms_id', 'Perms Id', 'required|valid_string[numeric]');
		$val->add_field('actions', 'Actions', 'required');
		return $val;
	}

	/**
	 * 読込後処理
	 */
	protected function _load()
	{
		// Actionsの非シリアル化
		$this->actions = \Accon\Library_Utility::un_serialize($this->actions, true);
	}

	/**
	 * 追加前処理
	 */
	protected function _before_insert()
	{
		$this->_permission_check_logic();
	}

	/**
	 * 更新前処理
	 */
	protected function _before_update()
	{
		$this->_before_insert();
	}

	/**
	 * model logic method
	 *
	 * アクションはパーミッションに定義されているもののみ有効とする
	 */
	private function _permission_check_logic()
	{
		$this->actions = $this->permission->get_save_actions($this->actions);
		if (empty($this->actions)){
			throw new \LogicException(ERROR_INVALID_SETTING);
		}
	}

}
