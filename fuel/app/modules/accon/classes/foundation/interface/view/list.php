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
 * Interface Interface_View_Physical_List
 * @package Accon\Foundation
 */
interface Interface_View_List {
	public function view_list($query = null);
	public function search_input($property = '');

}