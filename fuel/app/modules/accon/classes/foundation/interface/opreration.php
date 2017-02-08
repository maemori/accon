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
 * Interface Interface_Operations
 * @package Accon\Foundation
 */
interface Interface_Operation {
	/**
	 * Index action.
	 */
	public function action_index();

	/**
	 * view action.
	 */
	public function action_view($id = null);

	/**
	 * edit action.
	 */
	public function action_edit($id = null);

	/**
	 * create action.
	 */
	public function action_create();

	/**
	 * delete action.
	 */
	public function action_delete($id = null);

}