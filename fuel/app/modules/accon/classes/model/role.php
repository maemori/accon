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
 * Class Users_Role
 * @package Model\Service\Admin
 */
class Role extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users_roles';

	/**
	 * has_many relationships
	 *
	 * @var array
	 */
	protected static $_has_many = array(
		'role_permission' => array(
			'model_to' => '\Accon\Model\Role_permission',
			'key_from' => 'id',
			'key_to'   => 'role_id',
			'cascade_delete' => true,
		),
		'user_role' => array(
			'model_to' => '\Accon\Model\User_Role',
			'key_from' => 'id',
			'key_to'   => 'role_id',
			'cascade_delete' => true,
		),
		'group_role' => array(
			'model_to' => '\Accon\Model\Group_Role',
			'key_from' => 'id',
			'key_to'   => 'role_id',
			'cascade_delete' => true,
		),
	);

	/**
	 * many many relationships
	 *
	 * @var array
	 */
	protected static $_many_many = array(
		'users' => array(
			'key_from' => 'id',
			'model_to' => '\Accon\Model\User',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'role_id',
			'key_through_to' => 'user_id',
		),
		'groups' => array(
			'key_from' => 'id',
			'model_to' => '\Accon\Model\Group',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'role_id',
			'key_through_to' => 'group_id',
		),
		'permissions' => array(
			'key_from' => 'id',
			'model_to' => '\Accon\Model\Permission',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'role_id',
			'key_through_to' => 'perms_id',
		),
	);

	/**
	 * belongs to relationships
	 *
	 * @var array
	 */
	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => '\Accon\Model\User',
			'key_from' => 'user_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
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
		$val->add_field('name', 'Name', 'required|max_length[255]');
		return $val;
	}

	/**
	 * init the class
	 */
	public static function _init()
	{
		// set the relations through table names
		static::$_many_many['users']['table_through'] = \Config::get('ormauth.table_name', 'users').'_user_roles';
		static::$_many_many['groups']['table_through'] = \Config::get('ormauth.table_name', 'users').'_group_roles';
		static::$_many_many['permissions']['table_through'] = \Config::get('ormauth.table_name', 'users').'_role_permissions';
	}

	/**
	 * 追加前処理
	 */
	protected function _before_insert()
	{
		// assign the user id that lasted updated this record
		$this->user_id = ($this->user_id = \Auth::get_user_id()) ? $this->user_id[1] : 0;
	}

	/**
	 * 更新前処理
	 */
	protected function _before_update()
	{
		$this->_before_insert();
	}

}
