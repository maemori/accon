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

/**
 * Class View
 *
 * @package Accon
 */
class View extends \Fuel\Core\View
{
	private $_view_permissions = array();

	/**
	 * 画面内設置アクションの権限リストを返す
	 *
	 * @return array
	 */
	public function get_view_permissions()
	{
		return $this->_view_permissions;
	}

	/**
	 * Sets the view filename.
	 *
	 *     $view->set_filename($file);
	 *
	 * @param $file
	 * @return $this
	 * @throws \FuelException
	 */
	public function set_filename($file, $reverse = false)
	{
		// 指定されたファイルからパス情報を取得（拡張子削除）
		$pathinfo = pathinfo($file);
		empty($pathinfo['extension']) or $this->extension = $pathinfo['extension'];
		$file = $pathinfo['dirname'].DS.$pathinfo['filename'];
		// Viewの参照優先順位を組立 1:App > 2:Module > 3:Accon
		if (!in_array(APPPATH.'modules/accon/', \Finder::instance()->paths())) \Finder::instance()->add_path(APPPATH.'modules/accon/', -1);
		// Viewの参照先を更新
		\Finder::instance()->flash($this->request_paths);
		// Viewの参照先を設定.
		$multiple = \Finder::instance()->paths();
		// Viewのパスリストを取得
		if (($path = \Finder::search('views', $file, '.'.$this->extension, $multiple, false)) === false) {
			throw new \FuelException('The requested view could not be found: '.\Fuel::clean_path($file));
		}
		// 優先度が一番高いパスをセット
		if ($path) {
			$this->file_name = max($path);
		} else {
			$application_view = APPPATH.'views/'.$file.'.'.$this->extension;
			if (file_exists($application_view)){
				// 優先度が存在しない場合はアプリケーション側のファイルを設定
				$this->file_name = $application_view;
			} else {
				// 存在しない場合はfoundationを使用
				$this->file_name = APPPATH.'modules/accon/views/foundation/'.$pathinfo['filename'].'.'.EXTENSION_PHP;
			}
		}
		// ファイルの存在チェック
		if (!file_exists($this->file_name)){
			throw new \FuelException('The requested view could not be found: '.$this->file_name);
		}
		return $this;
	}

	/**
	 * 指定されたアクションのアクセス権限をセット
	 *
	 * @param string $permission
	 * @param bool $approval
	 */
	public function set_permission($permission = '', $approval = false)
	{
		$this->_view_permissions[$permission] = $approval;
	}

}
