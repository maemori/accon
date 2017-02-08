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

/**
 * Interface Interface_Model
 * @package Accon\Foundation
 */
interface Interface_Model {
	/**
	 * after_load observer event method
	 */
	public function _event_after_load();

	/**
	 * before_insert observer event method
	 */
	public function _event_before_insert();

	/**
	 * after_insert observer event method
	 */
	public function _event_after_insert();

	/**
	 * before_update observer event method
	 */
	public function _event_before_update();

	/**
	 * after_update observer event method
	 */
	public function _event_after_update();

	/**
	 * before_delete observer event method
	 */
	public function _event_before_delete();

	/**
	 * after_delete observer event method
	 */
	public function _event_after_delete();

}