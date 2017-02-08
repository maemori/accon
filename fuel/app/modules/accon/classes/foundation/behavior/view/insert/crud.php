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
 * Class Behavior_View_Insert_Crud
 *
 * Insert view 操作クラス.
 */
class Behavior_View_Insert_Crud extends Behavior_View implements Interface_View_Insert
{
	// View
	public $_view = null;

	/**
	 * View update.
	 *
	 * @param bool $standard_view
	 * @return \Fuel\Core\View|null
	 */
	public function view_insert($standard_view = true)
	{
		// Classの設定
		$class = $this->get_model_class();
		// Viewの生成
		if ($standard_view === true) {
			$this->_view = $this->view_creator(\View::forge(MODULE.'::'.FOUNDATION_ACTION_CREATE_PASS), false);
		} else if ($standard_view === false) {
			$this->_view = $this->view_creator(\View::forge($this->get_base_url().ACTION_CREATE), false);
		} else {
			$this->_view = $this->view_creator(\View::forge($this->get_base_url().$standard_view), false);
		}
		// Validationの設定
		$val = $class::validate(ACTION_CREATE);
		$this->_view->set_global('val', $val, false);
		// Model1の生成
		$this->_view->model = $class::forge();
		// Logging
		\Log::operation('[MODEL INSERT], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().
			', DATA:'.print_r($this->_view->model->to_array(), true), $this->get_method_name());
		return $this->_view;
	}

}