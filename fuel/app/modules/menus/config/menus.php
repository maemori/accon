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

return array(
	/**
	 * 公開ポイント
	 */
	'cache_prefix' => 'menus',

	/**
	 * 公開ポイント
	 */
	'publishing_point'	=> '/menus/menu',

	/**
	 * 公開ステータス
	 */
	'published_status' => array(
		array(
			'key' => '',
			'val' => '',
		),
		array(
			'key' => 'public',
			'val' => '公開',
		),
		array(
			'key' => 'close',
			'val' => '非公開',
		),
	),

);
