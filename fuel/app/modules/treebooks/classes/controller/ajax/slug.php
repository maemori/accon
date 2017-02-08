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

namespace Treebooks;

use Accon\Foundation\Controller_Ajax;
use Treebooks\Model\Slug;

/**
 * Class Controller_Ajax_Slug
 */
class Controller_Ajax_Slug extends Controller_Ajax
{
	/**
	 * Slugを使用したURLを返却
	 *
	 * @return object|string
	 */
	public function get_area()
	{
		$key = \Input::get('key');
		if (empty($key)) return $this->response('', 200);
		// クエリーの取得
		$query = Slug::query()
			->where(array('id', $key));
		// モデル取得
		$model = $query->get_one();
		// URLの組立
		$publishing_point = \Config::get('treebooks.publishing_point');
		$res = mb_strtolower($publishing_point.'/'.$model->code);
		$res = $this->response($res, 200);
		return $res;
	}

}
