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
 * 動的に生成されるコントローラーの基底クラス.
 */
abstract class Controller_Kinetic extends Controller_Accon implements Interface_View_List
{
	// 基準モデルクラス
	const MODEL = '';

	// VIEWのMENU部品
	const ACCON_MENU = '/foundation/_menu';
	const MENU = '_menu';

	// 画面生成オブジェクト
	protected $list_view_create;

	// 個別の振る舞いを実装するメソッド
	abstract protected function index();

	/**
	 * 前処理
	 *
	 * 自身のアクセス権限をチェック
	 */
	public function before()
	{
		parent::before();
		// 認可生成
		$class = \Config::get('accon.behavior.kinetic.acl');
		$this->acl = new $class;
		// アクセス権限チェック
		$this->set_area_name($this->request->module);
		$this->has_access();
		// Viewの状態を設定
		Behavior_View_Physical::before();
		// 基底URL
		$url = $this->get_area_name().'/'.$this->get_permission_name();
		// 末尾に/がない場合は付与
		if (substr($url,-1) != '/') $url .= '/';
		\Session::set('base_url', $url);
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
	 * View 検索画面用入力部品
	 *
	 * @param string $property
	 * @return mixed
	 */
	public function search_input($property = ''){
		return $this->list_view_create->search_input($property);
	}

	/**
	 * Index action.
	 *
	 * @return null
	 */
	public function action_index()
	{
		// 拡張クラスのindexアクション実行
		$view = $this->index();
		// 画面を返す
		return $this->view_finally($view);
	}

	/**
	 * 画面生成後処理（view_afterの後に実行）
	 *
	 * @param \View $view
	 * @return \View
	 */
	private function view_finally(\View $view = null){
		// URLの設定
		$view->set_global('base_url', \Session::get('base_url'), false);
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
		return $view;
	}

}

