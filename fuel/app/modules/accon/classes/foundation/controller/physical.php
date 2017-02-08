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
 * Class Controller_Physical
 *
 * 物理的に存在するコントローラーの基底クラス.
 */
abstract class Controller_Physical extends Controller_Accon
	implements Interface_Operation_Update,
	           Interface_Operation_Insert,
	           Interface_Operation_Remove,
	           Interface_View_List,
	           Interface_View_Single,
	           Interface_View_Update,
	           Interface_View_Insert
{
	// サービスの情報
	const SERVICE_TITLE = '';
	const SERVICE_SUB_TITLE = '';
	const SERVICE_DESCRIPTION = '';
	const SERVICE_KEYWORD = '';

	// 基準モデルクラス
	const MODEL = '';

	// VIEWのMENU部品
	const ACCON_MENU = '/foundation/_menu';
	const MENU = '_menu';

	// データ操作オブジェクト
	protected $insert;
	protected $update;
	protected $remove;

	// 画面生成オブジェクト
	protected $list_view_create;
	protected $single_view_create;
	protected $update_view_create;
	protected $insert_view_create;

	// 個別の振る舞いを実装するメソッド
	abstract protected function index();
	abstract protected function view($id = null);
	abstract protected function edit($id = null);
	abstract protected function create();
	abstract protected function delete($id = null);

	/**
	 * 前処理
	 *
	 * 自身のアクセス権限をチェック
	 */
	public function before()
	{
		parent::before();
		// 認可生成
		$class = \Config::get('accon.behavior.physical.acl');
		$this->acl = new $class;
		// アクセス権限チェック
		$this->has_access();
		// Viewの状態を設定
		Behavior_View_Physical::before();
	}

	/**
	 * 基準モデルクラスのクエリー取得
	 *
	 * @return mixed
	 */
	final protected function get_query() {
		$model = $this->get_model_class();
		return $model::query();
	}

	/**
	 * 基準モデルクラスの取得
	 *
	 * 拡張コントローラの定数値を設定
	 * @return string
	 */
	final protected function get_model_class() {
		return static::MODEL;
	}

	/**
	 * Model 追加処理
	 *
	 * @param \View $view
	 * @return mixed
	 */
	public function model_insert(\View $view = null){
		return $this->insert->model_insert($view);
	}

	/**
	 * Model 更新処理
	 *
	 * @param \View $view
	 * @return mixed
	 */
	public function model_update(\View $view = null){
		return $this->update->model_update($view);
	}

	/**
	 * Model 削除処理
	 *
	 * @param null $id
	 * @return mixed
	 */
	public function model_remove($id = null){
		return $this->remove->model_remove($id);
	}

	/**
	 * View 検索画面
	 *
	 * @param null $query
	 * @param bool $top_area
	 * @return mixed
	 */
	public function view_list($query = null, $top_area = false){
		return $this->list_view_create->view_list($query, $top_area);
	}

	/**
	 * View 照会画面
	 *
	 * @param null $id
	 * @param bool $standard_view
	 * @return mixed
	 */
	public function view_single($id = null, $standard_view = true){
		return $this->single_view_create->view_single($id, $standard_view);
	}

	/**
	 * View 更新画面
	 *
	 * @param null $id
	 * @param bool $standard_view
	 * @return mixed
	 */
	public function view_update($id = null, $standard_view = true){
		return $this->update_view_create->view_update($id, $standard_view);
	}

	/**
	 * View 追加画面
	 *
	 * @param bool $standard_view
	 * @return mixed
	 */
	public function view_insert($standard_view = true){
		return $this->insert_view_create->view_insert($standard_view);
	}

	/**
	 * View 検索画面用入力部品
	 *
	 * @param string $property
	 * @return mixed
	 */
	public function search_input($property = ''){
		return $this->list_view_create->search_input($property);
	}

	/**
	 * Viewセットの生成
	 *
	 * @param \view $view
	 * @return \Fuel\Core\View
	 */
	public function view_creator(\view $view) {
		return Behavior_View::view_creator($view);
	}

	/**
	 * Index action.
	 *
	 * @return null
	 */
	public function action_index()
	{
		// 検索条件を利用して作成画面を要求された場合
		if (\Input::post(PROCESSING) == SUBMIT_ADD) {
			// モデル追加要求
			if (parent::authority_action(ACTION_CREATE)) return $this->action_create();
		}
		// 拡張クラスのindexアクション実行
		$view = $this->index();
		// アプリ側画面生成の後処理
		$view = $this->view_after($view);
		// View制御値の保管
		$authority[ACTION_VIEW] = parent::authority_action(ACTION_VIEW); // 照会の権限
		$authority[ACTION_EDIT] = parent::authority_action(ACTION_EDIT); // 変更の権限
		$authority[ACTION_CREATE] = parent::authority_action(ACTION_CREATE); // 作成の権限
		$authority[ACTION_DELETE] = parent::authority_action(ACTION_DELETE); // 削除の権限
		$view->set_global('authority', $authority, false);
		// 画面を返す
		return $this->view_finally($view);
	}

	/**
	 * view action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	public function action_view($id = null)
	{
		// 拡張クラスのviewアクション実行
		$view = $this->view($id);
		// アプリ側画面生成の後処理
		$view = $this->view_after($view);
		// View制御値の保管
		$authority[ACTION_INDEX] = parent::authority_action(ACTION_INDEX); // 一覧照会の権限
		$authority[ACTION_EDIT] = parent::authority_action(ACTION_EDIT); // 変更の権限
		$authority[ACTION_VIEW] = parent::authority_action(ACTION_VIEW); // 照会の権限
		$view->set_global('authority', $authority, false);
		// ViewのForm部品のパスをセット
		$view->set_global('view_form', $this->get_base_url().VIEW_FORM, false);
		// 画面を返す
		return $this->view_finally($view);
	}

	/**
	 * edit action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	public function action_edit($id = null)
	{
		// 拡張クラスのeditアクション実行
		$view = $this->edit($id);
		// 更新処理
		$view = $this->model_update($view);
		// アプリ側画面生成の後処理
		$view = $this->view_after($view);
		// View制御値の保管
		$authority[ACTION_INDEX] = parent::authority_action(ACTION_INDEX); // 一覧照会の権限
		$authority[ACTION_VIEW] = parent::authority_action(ACTION_VIEW); // 照会の権限
		$authority[ACTION_EDIT] = parent::authority_action(ACTION_EDIT); // 変更の権限
		$authority[ACTION_CREATE] = parent::authority_action(ACTION_CREATE); // 作成の権限
		$view->set_global('authority', $authority, false);
		// ViewのForm部品のパスをセット
		$view->set_global('view_form', $this->get_base_url().VIEW_FORM, false);
		// 画面を返す
		return $this->view_finally($view);
	}

	/**
	 * create action.
	 *
	 * @return mixed
	 */
	public function action_create()
	{
		// 拡張クラスのcreateアクション実行
		$view = $this->create();
		// 追加処理
		$view = $this->model_insert($view);
		// アプリ側画面生成の後処理
		$view = $this->view_after($view);
		// View制御値の保管
		$authority[ACTION_INDEX] = parent::authority_action(ACTION_INDEX); // 一覧照会の権限
		$authority[ACTION_CREATE] = parent::authority_action(ACTION_CREATE); // 作成の権限
		$view->set_global('authority', $authority, false);
		// ViewのForm部品のパスをセット
		$view->set_global('view_form', $this->get_base_url().VIEW_FORM, false);
		// 画面を返す
		return $this->view_finally($view);
	}

	/**
	 * delete action.
	 *
	 * @param null $id
	 */
	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect($this->get_base_url());
		$this->delete($id);
		\Response::redirect_back(\Session::get('return_url'), 'refresh', 200);
	}

	/**
	 * view描写前補完
	 *
	 * @param \View $view
	 * @return \View
	 */
	protected function view_after(\View $view = null){
		return $view;
	}

	/**
	 * 画面生成後処理（view_afterの後に実行）
	 *
	 * @param \View $view
	 * @return \View
	 */
	private function view_finally(\View $view = null){
		// サービスの情報を設定
		if (is_null($view->get('title', null))) $view->set_global('title', static::SERVICE_TITLE, true);
		if (is_null($view->get('sub_title', null))) $view->set_global('sub_title', static::SERVICE_SUB_TITLE, true);
		if (is_null($view->get('description', null))) $view->set_global('description', static::SERVICE_DESCRIPTION, false);
		if (is_null($view->get('keyword', null))) $view->set_global('keyword', static::SERVICE_KEYWORD, true);
		// Menu部品のパスをセット
		if (file_exists(APPPATH.'views/'.$this->get_base_url().'/'.self::MENU.'.'.EXTENSION_PHP)){
			// Appl
			$view->set_global('view_menu', $this->get_base_url().'/'.self::MENU, false);
		} else if (parent::get_module() == MODULE) {
			// ACCONの場合、foundationを使用
			$view->set_global('view_menu', MODULE.'::'.self::ACCON_MENU, false);
		} else {
			// モジュール
			$view->set_global('view_menu', parent::get_module().'::'.$this->get_base_url().'/'.self::MENU, false);
		}
		// ViewにActionのURLを設定
		$view->set_global('action_url',
			array(
				ACTION_INDEX => $this->get_module().'/'.$this->get_base_url(),
				ACTION_VIEW => $this->get_module().'/'.$this->get_base_url().ACTION_VIEW.'/',
				ACTION_EDIT => $this->get_module().'/'.$this->get_base_url().ACTION_EDIT.'/',
				ACTION_CREATE => $this->get_module().'/'.$this->get_base_url().ACTION_CREATE.'/',
				ACTION_DELETE => $this->get_module().'/'.$this->get_base_url().ACTION_DELETE.'/',
			), false);
		// 権限リストをセット
		$view->set_global('view_permissions', $view->get_view_permissions(), false);
		return $view;
	}

}

