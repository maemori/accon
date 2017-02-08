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
 * Class Behavior_View_List_Crud
 *
 * List view 操作クラス.
 */
class Behavior_View_List_Crud extends Behavior_View implements Interface_View_List
{
	// View
	public $_view = null;
	// パジネーションのURL配置位置
	private $_pagination_uri_segment = 0;
	// 検索履歴の階層
	private $_search_count = 0;
	// 検索条件の格納
	private $_view_search = array();
	// View制御値の格納
	private $_view_control = array();

	/**
	 * コンストラクタ
	 */
	function __construct($model)
	{
		parent::__construct($model);
		// 検索履歴階層を設定
		$this->_search_count = \Session::get(\Request::active()->controller.'.search_count', 0);

	}

	/**
	 * create list view.
	 *
	 * @param null $query
	 * @param bool $top_area
	 * @return \Fuel\Core\View|null
	 */
	public function view_list($query = null, $top_area = false)
	{
		// Viewの生成
		$this->_view = $this->view_creator(\View::forge($this->get_base_url().ACTION_INDEX), $top_area);
		// 検索履歴制御
		$this->search_history();
		// パジネーション制御
		$query = $this->pagination($query);
		// Model取得
		$model = $query->get();
		// Viewにモデルを渡す
		$this->_view->set_global('model', $model, false);
		// Viewに制御値を渡す
		$this->_view->set_global('view_control', $this->_view_control, false);
		// Logging
		\Log::operation('[MODEL INDEX], USER ID:'.$this->get_user_id().', USER NAME:'.\Auth::get_screen_name().',
			DATA:'.print_r($query->get_query()->__toString(), true), $this->get_method_name());
		$debug_session = \Session::get(\Request::active()->controller, true);
		\Log::debug('Session:'.\Request::active()->controller.'-'.print_r($debug_session, true));
		// 画面を返す
		return $this->_view;
	}

	/**
	 * 絵検索条件の入力項目
	 *
	 * @param string $property
	 * @return array|mixed|string|void
	 */
	public function search_input($property = '')
	{
		// 検索履歴の階層制御
		if (!empty($property)) {
			switch (\Input::post(PROCESSING)) {
				case SUBMIT_SEARCH:
					// 画面から指定された条件で検索
					$ret = \Input::post($property);
					// セッションにView制御値を保存
					\Session::set(\Request::active()->controller.'.search.'.($this->_search_count + 1).'.'.$property, $ret);
					break;
				case SUBMIT_RESET:
					$ret = '';
					break;
				default :
					// SUBMIT_BACKとPOST以外は、保存された条件で検索
					if ($this->_search_count > 0) {
						if (\Input::method() == POST) {
							$ret = \Session::get(\Request::active()->controller.'.search.'.($this->_search_count - 1).'.'.$property);
						} else {
							$ret = \Session::get(\Request::active()->controller.'.search.'.$this->_search_count.'.'.$property);
						}
					} else {
						$ret = '';
					}
			}
			// View制御値の保管
			$this->_view_search[$property] = $ret;
		} else {
			$ret = '';
		}
		return $ret;
	}

	/**
	 * 検索履歴制御
	 */
	private function search_history()
	{
		// 検索履歴の階層制御
		if (\Input::method() == POST) {
			switch (\Input::post(PROCESSING)) {
				case SUBMIT_SEARCH:
					// 検索階層追加
					$this->_search_count += 1;
					// 検索条件が同じ場合、今回の値を削除
					$one_before = \Session::get(\Request::active()->controller . '.search.' . ($this->_search_count - 1));
					$now = \Session::get(\Request::active()->controller . '.search.' . ($this->_search_count));
					$now_val = is_null($now) ? null : array_filter($now, 'strlen');
					if ((is_null($one_before) and count($now_val) == 0) or $one_before == $now) {
						\Session::delete(\Request::active()->controller . '.search.' . $this->_search_count);
						$this->_search_count -= 1;
					}
					break;
				case SUBMIT_BACK:
					// 検索階層削除
					if ($this->_search_count > 0) {
						\Session::delete(\Request::active()->controller . '.search.' . $this->_search_count);
						$this->_search_count -= 1;
						break;
					}
				case SUBMIT_RESET:
					// 検索階層リセット
					$this->_search_count = 0;
					\Session::delete(\Request::active()->controller);
					break;
				default :
			}
		}
		// View制御値の保管
		$this->_view_control['search_count'] = $this->_search_count; // 検索回数
		// Viewに検索条件を渡す
		$this->_view_search = \Session::get(\Request::active()->controller . '.search.' . ($this->_search_count));
		$this->_view->set_global('view_search', $this->_view_search, false);
		// SessionにView制御値を保存
		\Session::set(\Request::active()->controller.'.search_count', $this->_search_count);
	}

	/**
	 * パジネーション制御
	 *
	 * @param null $query
	 * @return mixed
	 */
	private function pagination($query = null)
	{
		// Input処理
		if (\Input::post(PROCESSING) == SUBMIT_SEARCH) {
			// パジネーション単位の指定位置を画面から取得
			$search_row = \Input::post('rows');
		} else {
			// パジネーション単位の指定位置をセッションから取得
			$search_row = \Session::get(\Request::active()->controller.'.rows', 0);
		}
		// 件数取得
		$total_items = $query->count();
		// パジネーション単位数のリスト
		$pagination_rows = str_getcsv(PAGINATION_PER_PAGE_LIST);
		// パジネーション設定
		// パジネーションのURL配置位置を設定
		$this->_pagination_uri_segment = count(explode('_', \Request::active()->controller)) + 2;
		// Action名を設定
		$pagination_config = array(
			'pagination_url' => $this->get_module().'/'.$this->get_base_url().ACTION_INDEX.'/page',
			'per_page' => $pagination_rows[$search_row],
			'uri_segment' => $this->_pagination_uri_segment,
			'total_items' => $total_items,
			'show_first' => true,
			'show_last' => true,
		);
		// パジべネーションの生成
		$pagination = \Pagination::forge('pagination', $pagination_config);
		// View制御値の保管
		$this->_view_control['rows'] = $pagination_rows; // パジネーション単位の選択プルダウン用リスト
		$this->_view_control['row'] = $search_row; // パジネーション単位の選択値
		$this->_view_control['total_items'] = $total_items; // 件数
		// Viewにパジネーションを渡す
		$this->_view->set_global('pagination', $pagination, false);
		// Sessionにパジネーション単位の指定位置を保管
		\Session::set(\Request::active()->controller.'.rows', $search_row);
		// パジネーション情報を付与したQueryを返却
		return $query
			->limit($pagination->per_page)
			->offset($pagination->offset);
	}

}