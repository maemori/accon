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

namespace Accon;

/**
 * 管理サービスコントローラー
 *
 */
class Controller_Cache extends Foundation\Controller_Accon
{
	/**
	 * キャッシュのクリア
	 */
	public function action_delete()
	{
		// キャッシュを全てフラッシュ
		\Cache::delete_all();
		\Response::redirect_back();
	}

}