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
 * Class Behavior_Operation_Insert_Nested
 *
 * Insert action 操作クラス.
 */
class Behavior_Operation_Insert_Nested extends Behavior_Operation_Insert implements Interface_Operation_Insert
{
	/**
	 * Model insert.
	 *
	 * @param \View $view
	 * @return \View
	 * @throws \Exception
	 */
	public function model_insert(\View $view = null)
	{
		// 親モデル取得
		$id = \Session::get('parent_id');
		$class = get_class($view->model);
		$parent_model = $class::find($id);
		// 追加処理
		$view->set_global('model', $view->model, false);
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			//Validationの実行しモデルの保存
			if ($view->val->run()) {
				try {
					// モデルの保存
					if ($view->model and $view->model->child($parent_model)->save()) {
						\Log::operation('[MODEL INSERT - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', DATA:'.print_r($view->model->to_array(), true), $this->get_method_name());
						\Session::set_flash('success', SUCCESS_CREATE_MESSAGE);
						\Response::redirect(\Session::get('return_url'));
					} else {
						\Session::set_flash('error', ERROR_CREATE_MESSAGE);
					}
				} catch (\LogicException $e) {
					\Session::set_flash('error', $e->getMessage());
				} catch (\Exception $e) {
					\Log::error('[MODEL INSERT - AFTER], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().', ERROR MESSAGE:'.$e->getMessage(), $this->get_method_name());
					if ($e->getCode() == DATABASE_INTEGRITY_VIOLATION_CODE) {
						\Session::set_flash('error', ERROR_DATABASE_INTEGRITY_VIOLATION);
					} else {
						throw $e;
					}
				}
			}
		}
		return $view;
	}

}
