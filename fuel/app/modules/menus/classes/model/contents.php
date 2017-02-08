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

namespace Menus\Model;

use Accon\Foundation\Model_Nested;

/**
 * Class Contents
 * @package Menus\Model
 */
class Contents extends Model_Nested
{
	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'menus_contents';

	/**
	 * belongs_to relationships
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
		'permission' => array(
			'key_from' => 'perms_id',
			'model_to' => 'Accon\Model\Permission',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'menu' => array(
			'key_from' => 'menu_id',
			'model_to' => 'Menus\Model\Menu',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => true,
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
		$val->add_field('status', 'status', 'required|max_length[20]');
		$val->add_field('title', 'title', 'required|max_length[255]');
		$val->add_field('url', 'url', 'valid_url');
		return $val;
	}

	/**
	 * 読込後処理
	 */
	protected function _load()
	{
		// UNIX time change
		$this->public_at = \Date::forge($this->public_at)->format("%Y/%m/%d %H:%M");
	}

	/**
	 * 追加前処理
	 */
	protected function _before_insert()
	{
		// UNIX time change
		if (!is_null(\Input::post('public_at'))) {
			$this->public_at = strtotime(\Input::post('public_at'));
		} else {
			$this->public_at = strtotime($this->public_at);
		}
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
