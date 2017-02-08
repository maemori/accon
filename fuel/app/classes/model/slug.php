<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 kurobuta.jp Development Team
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     kurobuta.jp Development Team
 * @link       https://kurobuta.jp
 */

namespace Model;

/**
 * Class User
 * @package Model\Service\Admin
 */
class Slug extends \Accon\Foundation\Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'slug';

	/**
	 * belongs to relationships
	 *
	 * @var array
	 */
	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => 'Accon\Model\User',
			'key_from' => 'user_id',
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
		$val->add_field('name', 'Name', 'required|max_length[255]');
		return $val;
	}

	/**
	 * 前処理 追加
	 */
	protected function _before_insert()
	{
		// assign the user id that lasted updated this record
		$this->user_id = ($this->user_id = \Auth::get_user_id()) ? $this->user_id[1] : 0;
	}

	/**
	 * 前処理 更新
	 */
	protected function _before_update()
	{
		$this->_before_insert();
	}

}
