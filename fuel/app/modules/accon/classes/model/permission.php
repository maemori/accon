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
 * Class Users_Permission
 * @package Model\Service\Admin
 */
class Permission extends Model_Crud
{
	/**
	 * table name to overwrite assumption
	 *
	 * @var  string
	 */
	protected static $_table_name = 'users_permissions';

	/**
	 * has_many relationships
	 *
	 * @var array
	 */
	protected static $_has_many = array(
		'user_permission' => array(
			'model_to' => '\Accon\Model\User_Permission',
			'key_from' => 'id',
			'key_to'   => 'perms_id',
			'cascade_delete' => true,
		),
		'group_permission' => array(
			'model_to' => '\Accon\Model\Group_Permission',
			'key_from' => 'id',
			'key_to'   => 'perms_id',
			'cascade_delete' => true,
		),
		'role_permission' => array(
			'model_to' => '\Accon\Model\Role_Permission',
			'key_from' => 'id',
			'key_to'   => 'perms_id',
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
		$val->add_field('area', 'Area', 'required|max_length[25]');
		$val->add_field('permission', 'Permission', 'required|max_length[25]');
		$val->add_field('description', 'Description', 'required|max_length[255]');
		$val->add_field('actions', 'Actions', 'required');
		return $val;
	}

	/**
	 * 読込後処理
	 */
	protected function _load()
	{
		// Actionsの非シリアル化
		$this->actions = \Accon\Library_Utility::un_serialize($this->actions);
	}

	/**
	 * 追加前処理
	 */
	protected function _before_insert()
	{
		// Actionsのシリアル化
		$this->actions = \Accon\Library_Utility::serialize($this->actions);
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

	/**
	 * 格納用アクション生成
	 *
	 * @param string $actions
	 * @return string
	 */
	public function get_save_actions($actions = ''){
		if (empty($actions)) return '';
		$base_actions = \Accon\Library_Utility::replace($this->actions);
		$actions = \Accon\Library_Utility::replace($actions);
		foreach ($base_actions as $key => $value) {
			if (in_array($value, $actions)) {
				$save_actions[trim($value)] = $key;
			}
		}
		return isset($save_actions) ? serialize($save_actions) : '';
	}

	/**
	 * 全てのパーミッション用URL（エリア+パーミッション）のリストを取得
	 *
	 * @return array
	 */
	public static function get_urls(){
		$url_list = array();
		foreach (self::find('all', array('order_by' => array('area' => 'asc', 'permission' => 'asc'))) as $node) {
			if ($node->area == '/') {
				$url = '/'.$node->permission;
			} else {
				$url = $node->area.'/'.$node->permission;
			}
			$url_list[$url] = $node->id;
		}
		return $url_list;
	}

}
