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
 * Class Behavior_Operation_Update_Crud
 *
 * Update action 操作クラス.
 */
class Behavior_Operation_Update_Crud extends Behavior_Operation_Update implements Interface_Operation_Update
{
	/**
	 * Model update.
	 *
	 * @param \View $view
	 * @return \View
	 * @throws \Exception
	 */
	public function model_update(\View $view = null)
	{
		// Validationの実行
		if ($view->val->run()) {
			try {
				// モデルの保存
				if ($view->model and $view->model->save()) {
					\Log::operation('[MODEL UPDATE - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', DATA:'.print_r($view->model->to_array(), true), $this->get_method_name());
					\Session::set_flash('success', SUCCESS_UPDATE_MESSAGE.' ID:'.$view->model->id);
					// 呼び出し元画面へ遷移
					// \Response::redirect(\Session::get('return_url'));
				} else {
					\Session::set_flash('error', ERROR_UPDATE_MESSAGE.' ID:'.$view->model->id);
				}
			} catch (\LogicException $e) {
				\Session::set_flash('error', $e->getMessage());
			} catch (\Exception $e) {
				\Log::operation('[MODEL UPDATE - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', ERROR MESSAGE:'.$e->getMessage(), $this->get_method_name());
				if ($e->getCode() == DATABASE_INTEGRITY_VIOLATION_CODE) {
					\Session::set_flash('error', ERROR_DATABASE_INTEGRITY_VIOLATION);
				} else {
					throw $e;
				}
			}
		}
		return $view;
	}

}