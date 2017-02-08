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
 * Class Users_Group
 * @package Model\Service\Admin
 */
class Group extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users_groups';

	/**
	 * has many relationships
	 *
	 * @var array
	 */
	protected static $_has_many = array(
		'users' => array(
			'model_to' => '\Accon\Model\User',
			'key_from' => 'id',
			'key_to'   => 'group_id',
			'cascade_delete' => true,
		),
		'group_permission' => array(
			'model_to' => '\Accon\Model\Group_Permission',
			'key_from' => 'id',
			'key_to'   => 'group_id',
			'cascade_delete' => true,
		),
		'group_role' => array(
			'model_to' => '\Accon\Model\Group_Role',
			'key_from' => 'id',
			'key_to'   => 'group_id',
			'cascade_delete' => true,
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
