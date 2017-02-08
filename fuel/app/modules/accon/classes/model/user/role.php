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
 * Class Users_User_Role
 * @package Model\Service\Admin
 */
class User_Role extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users_user_roles';

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
		'role' => array(
			'key_from' => 'role_id',
			'model_to' => '\Accon\Model\Role',
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
		$val->add_field('role_id', 'Role Id', 'required|valid_string[numeric]');
		return $val;
	}

}
