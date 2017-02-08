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

namespace Menus;

use Accon\Foundation\Controller_Accon_Rest;
use Menus\Model\Contents;
use Accon\Model\Permission;

/**
 * Class Controller_Ajax_Slug
 */
class Controller_Ajax_Menu extends Controller_Accon_Rest
{
	/**
	 * 公開されているメニューのリストを返却
	 *
	 * @return object|string
	 */
	public function get_list()
	{
		$res = '';
		// fetch the current user object
		$cache_key = \Config::get('menus.cache_prefix', 'auth').'.menus.list.user_'.$this->get_user_id();
		try {
			// assemble the current users effective rights
			$res = \Cache::get($cache_key);
		} catch (\CacheNotFoundException $e) {
			// クエリーの取得
			$query = Contents::query()
				->related('menu')
				->where('status', 'public')
				->where('public_at', '<=', time())
				->where('menu.top_display_flag', 0)
				->order_by('menu.sort', 'asc')
				->order_by('public_at', 'desc')
				->order_by('title', 'asc');
			$model = $query->get();
			foreach ($model as $item) {
				if ($this->approval($item)) {
					$res .= '<li><a href="" data-toggle="modal" data-target="#'.$item->permission->permission.'">';
					$res .= '<span class="glyphicon glyphicon-ok-sign"></span>&nbsp;'.$item->title.'</a></li>';
				}
			}
			\Cache::set($cache_key, $res);
		}
		$res = $this->response($res, 200);
		return $res;
	}

	/**
	 * 公開されているメニューを返却
	 *
	 * @return object|string
	 */
	public function get_items()
	{
		$res = '';
		// fetch the current user object
		$cache_key = \Config::get('menus.cache_prefix', 'auth').'.menus.items.user_'.$this->get_user_id();
		try {
			// assemble the current users effective rights
			$res = \Cache::get($cache_key);
		} catch (\CacheNotFoundException $e) {
			// クエリーの取得
			$query = Contents::query()
				->related('menu')
				->where('status', 'public')
				->where('menu.top_display_flag', 0)
				->order_by('menu.sort', 'asc')
				->order_by('public_at', 'desc')
				->order_by('title', 'asc');
			$model = $query->get();
			foreach ($model as $item) {
				$all = $item->dump_tree($item);
				$tree = $this->tree($all);
				if (!is_null($tree)) {
					$res .= '<div class="modal fade" id="'.$item->permission->permission.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
					$res .= '<div class="modal-dialog">';
					$res .= '<div class="modal-content">';
					$res .= '<div class="modal-header">';
					$res .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					$res .= '<h4 class="modal-title" id="myModalLabel">'.$item->title.'</h4>';
					$res .= '</div>';
					$res .= '<div class="modal-body">';
					$res .= \Menus\Library_Utility::tree_front_output($tree);
					$res .= '</ul>';
					$res .= '</div>';
					$res .= '<div class="modal-footer">';
					$res .= '</div>';
					$res .= '</div>';
					$res .= '</div>';
					$res .= '</div>';
				}
			}
			\Cache::set($cache_key, $res);
		}
		$res = $this->response($res, 200);
		return $res;
	}

	/**
	 * 指定配下のTreeを返す
	 *
	 * @param null $model
	 * @return array
	 */
	protected function tree($model = null)
	{
		try {
			if ($this->approval($model)) {
				$children = array();
				$kids = $model->children()->get();
				if ($kids) {
					foreach ($kids as $item){
						if ($item->status == 'public' and $item->public_at <= \Date::forge(time())->format("%Y/%m/%d %H:%M")){
							$leaf = self::children($item);
							if ($leaf) {
								array_push($children, $leaf);
							}
						}
					}
				}
				if (count($children) == 0) return null;
				$area = isset($model->permission->area) ? $model->permission->area : '';
				$permission = isset($model->permission->permission) ? $model->permission->permission : '';
				if (!empty($area)) {
					return array(
						'left_id' => $model->left_id,
						'id' => $model->id,
						'title' => $model->title,
						'description' => $model->description,
						'url' => $model->url,
						'area' => $area,
						'permission' => $permission,
						'children' => $children,
						'is_leaf' => $model->is_leaf()
					);
				} else {
					return null;
				}
			}
		} catch (\Exception $e) {
			$this->response(array('status'=> 0, 'error'=> $e->getMessage()), 500);} finally {
		}
	}

	/**
	 * 指定要素配下を再帰的に返す
	 *
	 * @param null $model
	 * @return array
	 */
	private function children($model = null)
	{
		try {
			if ($this->approval($model)) {
				$children = array();
				$kids = $model->children()->get();
				if (isset($kids)) {
					foreach ($kids as $item) {
						if ($item->status == 'public' and $item->public_at <= \Date::forge(time())->format("%Y/%m/%d %H:%M")){
							// 再帰
							$leaf = self::children($item);
							if ($leaf) {
								array_push($children, $leaf);
							}
						}
					}
				}
				if (count($children) == 0 and empty($model->url) and $model->perms_id == 0) return null;
				return array(
					'left_id' => $model->left_id,
					'id' => $model->id,
					'title' => $model->title,
					'description' => $model->description,
					'url' => $model->url,
					'area' => $model->permission->area,
					'permission' => $model->permission->permission,
					'children' => $children,
					'is_leaf' => $model->is_leaf()
				);
			}
		} catch (\Exception $e) {
			$this->response(array('status'=> 0, 'error'=> $e->getMessage()), 500);} finally {
		}
	}

	/**
	 * パーミッションの指定がある場合は、権限があるメニューのみ生成
	 *
	 * @param $model
	 * @return bool
	 */
	private function approval(&$model)
	{
		$auth = true;
		if ($model->perms_id != 0) {
			$auth = $this->authority($model->permission->area, $model->permission->permission, 'index');
		} else {
			$model->permission = Permission::forge();
			$model->permission->area = '';
			$model->permission->permission = '';
		}
		return $auth;
	}

}