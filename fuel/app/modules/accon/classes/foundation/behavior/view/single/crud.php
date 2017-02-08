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
 * Class Behavior_View_Single_Crud
 *
 * Single view 操作クラス.
 */
class Behavior_View_Single_Crud extends Behavior_View implements Interface_View_Single
{
	// View
	public $_view = null;

	/**
	 * View Single.
	 *
	 * @param null $id
	 * @param bool $standard_view
	 * @return \Fuel\Core\View|null
	 */
	public function view_single($id = null, $standard_view = true)
	{
		// Classの設定
		$class = $this->get_model_class();
		// Viewの生成
		if ($standard_view === true) {
			$this->_view = $this->view_creator(\View::forge(MODULE.'::'.FOUNDATION_ACTION_VIEW_PASS), false);
		} else if ($standard_view === false) {
			$this->_view = $this->view_creator(\View::forge($this->get_base_url().ACTION_VIEW), false);
		} else {
			$this->_view = $this->view_creator(\View::forge($this->get_base_url().$standard_view), false);
		}
		// パラメータ確認
		is_null($id) and \Response::redirect(\Session::get('return_url'));
		// モデルの取得
		if (!$model = $class::find($id)) {
			\Session::set_flash('error', ERROR_DATA_NOT_EXIST_MESSAGE.' ID:'.$id);
			\Response::redirect(\Session::get('return_url'));
		}
		$this->_view->set_global('model', $model, false);
		// Validationの設定
		$val = $model::validate(ACTION_VIEW);
		$this->_view->set_global('val', $val, false);
		// Logging
		\Log::operation('[MODEL VIEW], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().
			', DATA:'.print_r($this->_view->model->to_array(), true), $this->get_method_name());
		return $this->_view;
	}

}