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

use Accon\Foundation\Model_Crud;

/**
 * Class User
 * @package Model\Service\Admin
 */
class Post extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'posts';

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
		'slug' => array(
			'key_from' => 'slug_id',
			'model_to' => 'Model\Slug',
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
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('slug_id', 'Slug id', 'required|valid_string[numeric]');
		$val->add_field('post_status', 'Post status', 'required|max_length[45]');
		$val->add_field('public_at', 'Public at', 'required');
		$val->add_field('summary', 'Summary', 'required');
		$val->add_field('body', 'Body', 'required');
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
	 * 前処理 追加
	 */
	protected function _before_insert()
	{
		// UNIX time change
		$this->public_at = strtotime(\Input::post('public_at'));
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
