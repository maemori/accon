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
 * Class Users_Group_Role
 * @package Model\Service\Admin
 */
class Group_Role extends Model_Crud
{
	/**
	 * name to overwrite assumption
	 *
	 * @var  string  table
	 */
	protected static $_table_name = 'users_group_roles';

	/**
	 * defined observers
	 *
	 * @var array
	 */
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	/**
	 * belongs to relationships
	 *
	 * @var array
	 */
	protected static $_belongs_to = array(
		'group' => array(
			'key_from' => 'group_id',
			'model_to' => '\Accon\Model\Group',
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
		$val->add_field('group_id', 'Group Id', 'required|valid_string[numeric]');
		$val->add_field('role_id', 'Role Id', 'required|valid_string[numeric]');
		return $val;
	}

}
