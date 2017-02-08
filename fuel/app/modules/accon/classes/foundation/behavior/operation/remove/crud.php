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
 * Class Behavior_Operation_Remove_Crud
 *
 * Delete action 操作クラス.
 */
class Behavior_Operation_Remove_Crud extends Behavior_Operation_Remove implements Interface_Operation_Remove
{
	/**
	 * Model remove.
	 *
	 * @param null $id
	 * @throws \Exception
	 */
	public function model_remove($id = null)
	{
		// Classの設定
		$class = $this->get_model_class();
		$model = $class::find($id);
		try {
			// モデルの削除
			if ($model) {
				\Log::operation('[MODEL DELETE - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', DATA:'.print_r($model->to_array(), true), $this->get_method_name());
				// モデルの削除
				$model->delete();
				\Session::set_flash('success', SUCCESS_DELETE_MESSAGE.' ID:'.$id);
			} else {
				\Session::set_flash('error', ERROR_DELETE_MESSAGE.' ID:'.$id);
			}
		} catch (\LogicException $e) {
			\Session::set_flash('error', $e->getMessage());
		} catch (\DomainException $e) {
			\Session::set_flash('error', ERROR_CHILDREN_DELETE_MESSAGE.' ID:'.$id);
		} catch (\Exception $e) {
			\Log::operation('[MODEL DELETE - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', ERROR MESSAGE:'.$e->getMessage(), $this->get_method_name());
			throw $e;
		} finally {
		}
	}

}