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
 * Class Controller_Foundation_Nested
 *
 * 再帰的な入れ子構造モデルの振る舞いを提供するクラス.
 */
abstract class Controller_Physical_Nested extends Controller_Physical
{
	/**
	 * 前処理.
	 */
	public function before()
	{
		parent::before();
		// モデル操作生成
		$class = \Config::get('accon.behavior.physical.nested.operation.insert');
		$this->insert = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.nested.operation.update');
		$this->update = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.nested.operation.remove');
		$this->remove = new $class($this->get_model_class());
		// 画面生成
		$class = \Config::get('accon.behavior.physical.nested.view.list');
		$this->list_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.nested.view.single');
		$this->single_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.nested.view.update');
		$this->update_view_create = new $class($this->get_model_class());
		$class = \Config::get('accon.behavior.physical.nested.view.insert');
		$this->insert_view_create = new $class($this->get_model_class());
	}

	/**
	 * tree child action.
	 *
	 * 上の階層へ移動
	 */
	public function action_parent()
	{
		// Getパラメータ取得
		$id = \Input::get('id');
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 親のモデルを取得
		$root = $entry->root()->get_one();
		$parent = $entry->parent()->get_one();
		// 親のモデルの下に自身を保存
		if ($root != $parent) $entry->next_sibling($parent)->save();
		// 呼び出しに戻る
		\Response::redirect_back();
	}

	/**
	 * tree child action.
	 *
	 * 同一階層で上の子要素へ移動
	 */
	public function action_child()
	{
		// Getパラメータ取得
		$id = \Input::get('id');
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 上のモデルを取得
		$sibling = $entry->previous_sibling()->get_one();
		// 上のモデルの子に自身を保存
		if ($sibling) $entry->child($sibling)->save();
		// 呼び出しに戻る
		\Response::redirect_back();
	}

	/**
	 * tree up action.
	 *
	 * 同一階層で上へ移動
	 */
	public function action_up()
	{
		// Getパラメータ取得
		$id = \Input::get('id');
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 上のモデルを取得
		$sibling = $entry->previous_sibling()->get_one();
		// 上のモデルの上に自身を保存
		if ($sibling) $entry->previous_sibling($sibling)->save();
		// 呼び出しに戻る
		\Response::redirect_back();
	}

	/**
	 * tree down action.
	 *
	 * 同一階層で下へ移動
	 */
	public function action_down()
	{
		// Getパラメータ取得
		$id = \Input::get('id');
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 上のモデルを取得
		$sibling = $entry->next_sibling()->get_one();
		// 上のモデルの上に自身を保存
		if ($sibling) $entry->next_sibling($sibling)->save();
		// 呼び出しに戻る
		\Response::redirect_back();
	}

}
