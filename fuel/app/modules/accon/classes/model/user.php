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
 * Class User
 * @package Model\Service\Admin
 */
class User extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users';

	/**
	 * has many relationships
	 *
	 * @var array
	 */
	protected static $_has_many = array(
		'metadata' => array(
			'model_to' => '\Auth\Model\Auth_Metadata',
			'key_from' => 'id',
			'key_to'   => 'parent_id',
			'cascade_delete' => true,
		),
		'user_permission' => array(
			'model_to' => '\Accon\Model\User_Permission',
			'key_from' => 'id',
			'key_to'   => 'user_id',
			'cascade_delete' => true,
		),
	);

	/**
	 * belongs_to relationships
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
		),
		'group' => array(
			'model_to' => '\Accon\Model\Group',
			'key_from' => 'group_id',
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
		$val->add_field('username', 'Username', 'required|max_length[50]');
		$val->add_field('group_id', 'Group Id', 'required|valid_string[numeric]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		return $val;
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
