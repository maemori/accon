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
Autoloader::add_core_namespace('Accon');

// Classのロード
Autoloader::add_classes(array(
	'View' => APPPATH.'modules/accon/classes/foundation/view.php',
	'Log' => APPPATH.'modules/accon/classes/foundation/log.php',
));

// 設定の読み込み
\Config::load('accon::accon', 'accon');
//\Config::load('accon', 'accon');

// 定数の読み込み
require APPPATH.'modules/accon/config/constant.php';
require APPPATH.'modules/accon/lang/jp/constant.php';
require APPPATH.'modules/accon/lang/jp/messages.php';

