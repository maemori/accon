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
 * Interface Interface_Operation
 * @package Accon\Foundation
 */
interface Interface_Operation_Remove {
	/**
	 * data processing.
	 *
	 * @param null $id
	 * @return mixed
	 */
	public function model_remove($id = null);

}