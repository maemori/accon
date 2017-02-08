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

use \Orm\Observer;

/**
 * DeleteAt observer.
 */
class Observer_DeleteAt extends Observer
{
	/**
	 * @var  string  property to set the timestamp on
	 */
	public static $property = 'delete_at';

	/**
	 * @var  string  property to set the timestamp on
	 */
	protected $_property;

	/**
	 * Set the properties for this observer instance, based on the parent model's
	 * configuration or the defined defaults.
	 *
	 * @param $class  Model class this observer is called on
	 */
	public function __construct($class)
	{
		$props = $class::observers(get_class($this));
		$this->_property = isset($props['property']) ? $props['property'] : static::$property;
	}

	/**
	 * before delete.
	 */
	public function before_delete()
	{
	}

	/**
	 * after delete.
	 */
	public function after_delete()
	{
	}

}
