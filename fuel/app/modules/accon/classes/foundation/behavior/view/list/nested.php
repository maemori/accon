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

use \Orm\Query;

/**
 * Class Behavior_View_List_Nested
 *
 * List view 操作クラス.
 */
class Behavior_View_List_Nested extends Behavior_View implements Interface_View_List
{
	// View
	public $_view = null;

	/**
	 * create list view.
	 *
	 * @param null $query
	 * @param bool $top_area
	 * @return \Fuel\Core\View
	 */
	public function view_list($query = null, $top_area = false)
	{
		// ID設定
		$id = $query;
		// Viewの生成
		$view = $this->view_creator(\View::forge($this->get_base_url().ACTION_INDEX), $top_area);
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// カレントモデル取得
		$entry = $model_class::find($query);
		if (is_null($entry)) \Response::redirect_back(\Session::get('return_url'), 'refresh', 200);
		$view->set_global('entry', $entry, false);
		// ターゲットモデル
		$model = $entry->children()->get();
		// rootモデル取得
		$root = $entry->root()->get_one();
		// 全体Tree取得
		$all = $root->dump_tree($root);
		$tree = self::tree($all);
		$view->set_global('tree', $tree, false);
		// root直下フラグ
		if ($root->id == $entry->id) {
			$view->set_global('root_children', true, false);
		} else {
			$view->set_global('root_children', false, false);
		}
		// カレントの1階層下のモデル
		if ($model) {
			// 最初の子
			$view->set_global('first_child_id', $entry->first_child()->get_one()->id, false);
			// 最後の子
			$view->set_global('last_child_id', $entry->last_child()->get_one()->id, false);
		}
		// 自身のID
		$view->set_global('parent_id', $id, false);
		// 一つ前のIDを設定
		$previous_id = self::get_previous_id($id);
		$view->set_global('previous_id', $previous_id, false);
		// 一つ次のIDを設定
		$view->set_global('following_id', self::get_following_id($id), false);
		// 先祖のリストを設定
		$view->set_global('ancestors_list', self::get_ancestors_list($id), false);
		// Viewにモデルをセット
		$view->set_global('model', $model, false);
		// 画面を返す
		return $view;
	}

	/**
	 * 指定配下のTreeを返す
	 *
	 * @param null $model
	 * @return array
	 */
	private function tree($model = null)
	{
		$children = array();
		$kids = $model->children()->get();
		if ($kids) {
			foreach ($kids as $item){
				array_push($children, self::children($item));
			}
		}
		return array(
			'left_id' => $model->left_id,
			'id' => $model->id,
			'title' => $model->title,
			'children' => $children,
			'is_leaf' => $model->is_leaf()
		);
	}

	/**
	 * 指定要素配下を再帰的に返す
	 *
	 * @param null $model
	 * @return array
	 */
	private function children($model = null)
	{
		$son = array();
		$kids = $model->children()->get();
		if (isset($kids)) {
			foreach ($kids as $item) {
				array_push($son, self::children($item));
			}
		}
		return array(
			'left_id' => $model->left_id,
			'id' => $model->id,
			'title' => $model->title,
			'children' => $son,
			'is_leaf' => $model->is_leaf()
		);
	}

	/**
	 * get_previous_id.
	 *
	 * 一つ前のIDを取得
	 * @param $id
	 * @return bool
	 */
	private function get_previous_id($id)
	{
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 自身よりleftが小さい最初のものを取得
		$target = $model_class::find('first', array(
			'where' => array(
				array('tree_id', $entry->tree_id),
				array('left_id', '<', $entry->left_id),
			),
			'order_by' => array('left_id' => 'desc'),
		));
		if (empty($target)) return false;
		return $target->id;
	}

	/**
	 * get_following_id.
	 *
	 * 一つ次のIDを取得
	 * @param $id
	 * @return bool
	 */
	private function get_following_id($id)
	{
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 自身よりleftが大きい最初のものを取得
		$target = $model_class::find('first', array(
			'where' => array(
				array('tree_id', $entry->tree_id),
				array('left_id', '>', $entry->left_id),
			),
			'order_by' => array('left_id' => 'asc'),
		));
		if (empty($target)) return false;
		return $target->id;
	}

	/**
	 * get_ancestors_list.
	 *
	 * 先祖のリストを取得
	 * @param $id
	 * @return array
	 */
	private function get_ancestors_list($id)
	{
		$parent_list = array();
		// 基準モデルクラス取得
		$model_class = $this->get_model_class();
		// 自身のモデルを取得
		$entry = $model_class::find($id);
		// 全ての先祖を取得
		$parent = $entry->ancestors()->get();
		// idとタイトルをリストに格納
		foreach ($parent as $item) {
			array_push($parent_list, array('id' => $item->id, 'title' => $item->title));
		}
		return $parent_list;
	}

	/**
	 * 絵検索条件の入力項目
	 *
	 * @param string $property
	 * @return array|mixed|string|void
	 */
	public function search_input($property = '')
	{
	}

}