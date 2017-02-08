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
 * Class Behavior_Acl_Rest
 *
 * Rest用のアクセス制御.
 */
class Behavior_Acl_Rest extends Behavior_Acl implements Interface_Acl
{
	/**
	 * アクセス権限をチェック
	 *
	 * @return bool
	 */
	public function has_access()
	{
		// アクセス制御処理にチェック対象を設定
		$this->set_request(\Request::active());
		// アクセス権限チェック
		return parent::has_access();
	}

}