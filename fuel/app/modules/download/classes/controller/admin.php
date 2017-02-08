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

namespace Download;

use Accon\Foundation\Controller_Physical_Crud;
use Download\Model\Download;

/**
 * Class Controller_Admin_Group
 */
class Controller_Admin extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = '管理';
	const SERVICE_SUB_TITLE = 'ダウンロード管理';
	const SERVICE_DESCRIPTION = '配布物の管理';
	const SERVICE_KEYWORD = 'php,fuelphp,kurobuta.jp,管理,グループ';
	// モデルクラス
	const MODEL = Download::class;

	// 公開ステータスリスト
	private static $_status = array(
		array(
			'key' => '',
			'val' => '',
		),
		array(
			'key' => 'public',
			'val' => '公開',
		),
		array(
			'key' => 'close',
			'val' => '非公開',
		),
	);

	/**
	 * edit action.
	 *
	 * @param null $id
	 * @return \Fuel\Core\View
	 */
	protected function edit($id = null)
	{
		// viewの構築
		$view = $this->view_update($id, false);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->description = \Input::post('description');
			// アップロード処理
			if (\Upload::is_valid()) {
				\Upload::save(); // ファイル格納
				$old_file = $view->model->pass.$view->model->saved_as;
				if (is_file($old_file)) {
					// ファイル削除
					if (!unlink($old_file)) {
						$error_message = 'ファイルの削除に失敗しました('.$old_file.')。';
						\Log::error($error_message);
					}
				}
				foreach (\Upload::get_files() as $node) {
					\log::info('FILE:'.print_r($node, true));
					$view->model->pass = $node['saved_to'];
					$view->model->saved_as = $node['saved_as'];
					$view->model->name = $node['name'];
				}
			}
		}
		// Viewを返す
		return $view;
	}

	/**
	 * create action.
	 *
	 * @return \Fuel\Core\View
	 * @throws \Exception
	 */
	protected function create()
	{
		// viewの構築
		$view = $this->view_insert(false);
		// モデルへ値設定
		if (\Input::method() == POST) {
			// 画面の値を設定
			$view->model->title = \Input::post('title');
			$view->model->status = \Input::post('status');
			$view->model->public_at = \Input::post('public_at');
			$view->model->description = \Input::post('description');
			$view->model->impressions = 0;
			$view->model->get_number = 0;
		}
		// 作成
		if (\Input::post(PROCESSING) == SUBMIT_CREATE) {
			// Validationの実行
			if ($view->val->run()) {
				// アップロード処理
				if (\Upload::is_valid()) {
					\Upload::save(); // ファイル格納
					foreach (\Upload::get_files() as $node) {
						\log::info('FILE:'.print_r($node, true));
						$view->model->pass = $node['saved_to'];
						$view->model->saved_as = $node['saved_as'];
						$view->model->name = $node['name'];
					}
				}
			}
		}
		// Viewを返す
		return $view;
	}

	/**
	 * delete action.
	 *
	 * @param null $id
	 */
	protected function delete($id = null)
	{
		// Modelの構築
		$model = Download::find($id);
		// ファイル削除
		if (file_exists($model->pass.$model->saved_as)) {
			// ファイル削除
			if (!unlink($model->pass.$model->saved_as)) {
				$error_message = 'ファイルの削除に失敗しました('.$model->pass.$model->saved_as.')。';
				\Log::error($error_message);
			}
		}
		// 削除
		$this->model_remove($id);
	}

	/**
	 * view描写前補間
	 *
	 * @param null $view
	 * @return null
	 */
	/**
	 * @param \vIEW $view
	 * @return \vIEW
	 */
	protected function view_after(\vIEW $view = null){
		// Viewにフィルターのリストをセット
		$view->set_global('status', \Arr::assoc_to_keyval(self::$_status, 'key', 'val'));
		return $view;
	}

}
