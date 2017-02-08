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

namespace Accon\Foundation;

use \Orm\Model;

/**
 * Class Foundation_Crud
 * @package Accon\Model
 */
abstract class Model_Crud extends Model implements Interface_Model
{
	/**
	 * @var array	defined observers
	 */
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false
		),
		'Orm\\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false
		),
		'Accon\\Foundation\\DeleteAt' => array(
			'events' => array('after_delete'),
			'property' => 'delete_at',
		),
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load', 'before_save', 'after_save')
		),
		'Orm\\Observer_Self' => array(
			'events' => array(
				'after_load',
				'before_insert',
				'after_insert',
				'before_update',
				'after_update',
				'before_delete',
				'after_delete',
				),
			'property' => 'user_id'
		),
	);

	/**
	 * after_load observer event method
	 */
	final public function _event_after_load()
	{
		$this->_load();
	}

	/**
	 * before_insert observer event method
	 */
	final public function _event_before_insert()
	{
		$this->_before_insert();
	}

	/**
	 * after_insert observer event method
	 */
	final public function _event_after_insert()
	{
		$this->_after_insert();
	}

	/**
	 * before_update observer event method
	 */
	final public function _event_before_update()
	{
		$this->_before_update();
	}

	/**
	 * after_update observer event method
	 */
	final public function _event_after_update()
	{
		$this->_after_update();
	}

	/**
	 * before_delete observer event method
	 */
	final public function _event_before_delete()
	{
		$this->_before_delete();
	}

	/**
	 * after_delete observer event method
	 */
	final public function _event_after_delete()
	{
		$this->_after_delete();
	}

	/**
	 * 読込後処理.【Extending child element】The default implementation.
	 */
	protected function _load()
	{
	}

	/**
	 * 追加前処理.【Extending child element】The default implementation.
	 */
	protected function _before_insert()
	{
	}

	/**
	 * 更新前処理.【Extending child element】The default implementation.
	 */
	protected function _before_update()
	{
	}

	/**
	 * 削除前処理.【Extending child element】The default implementation.
	 */
	protected function _before_delete()
	{
	}

	/**
	 * 追加後処理.【Extending child element】The default implementation.
	 */
	protected function _after_insert()
	{
	}

	/**
	 * 更新後処理.【Extending child element】The default implementation.
	 */
	protected function _after_update()
	{
	}

	/**
	 * 削除後処理.【Extending child element】The default implementation.
	 */
	protected function _after_delete()
	{
	}

}