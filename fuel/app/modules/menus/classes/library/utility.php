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

/**
 * Class Library_Utility
 */
class Library_Utility
{
	/**
	 * Root階層出力
	 *
	 * @param int $this_id
	 * @param null $items
	 */
	public static function tree_output($this_id = 0, $items = null){
		echo '<ul class="tree">';
		echo '<li>';
		if (!empty($items)) {
			if ($this_id == $items['id']) {
				$style = 'btn btn-info';
				$child_view = true;
			} else {
				$style = 'btn btn-default';
				$child_view = false;
			}
			echo \Html::anchor('/menus/contents/?id='.$items['id'],
				'<div class="text-left"><span title="Book" class="glyphicon glyphicon-book"></span>&nbsp;'.
					mb_strimwidth($items['title'], 0, 16, '...', 'UTF-8' ).'</div>',
					array(
						'class' => $style,
						'title'=> $items['title'],
					));
			self::tree_children($this_id, $items, $child_view);
		}
		echo '</li>';
		echo '</ul>';
	}

	/**
	 * 再帰的に子を出力
	 *
	 * @param int $this_id
	 * @param null $items
	 * @param bool $child_view
	 */
	public static function tree_children($this_id = 0, $items = null, $child_view = false){
		echo '<ul>';
		$child_view_flg = $child_view;
		$child_view = false;
		foreach ($items['children'] as $item){
			if (isset($item['children'])) {
				if ($this_id == $item['id']) {
					$style = 'btn btn-info';
					$child_view = true;
				} elseif ($child_view_flg){
					$style = 'btn btn-primary';
				} else {
					$style = 'btn btn-default';
				}
				echo '<li>';
				if (!$item['is_leaf']) {
					echo \Html::anchor('/menus/contents/?id='.$item['id'],
						'<div class="text-left"><span title="Menu" class="glyphicon glyphicon-list"></span>&nbsp;'.
							mb_strimwidth($item['title'], 0, 16, '...', 'UTF-8' ).'</div>',
							array(
								'class' => $style,
								'title'=> $item['title'],
							));
				} else {
					echo \Html::anchor('/menus/contents/?id='.$item['id'],
						'<div class="text-left"><span title="Menu" class="glyphicon glyphicon-list-alt"></span>&nbsp;'.
							mb_strimwidth($item['title'], 0, 16, '...', 'UTF-8' ).'</div>',
							array(
								'class' => $style,
								'title'=> $item['title'],
							));
				}
				self::tree_children($this_id, $item, $child_view);
				echo '</li>';
			}
			if ($child_view) $child_view = false;
		}
		echo '</ul>';
	}

	/**
	 * Root階層出力
	 *
	 * @param null $items
	 * @param string $res
	 * @return string
	 */
	public static function tree_front_output($items = null, $res = ''){
		if (is_null($items)) return $res;
		$res .= '<ul class="list-group">';
		foreach ($items['children'] as $item){
			$res .= '<li class="list-group-item"><div class="text-left">';
			// URLの組立
			$url = self::get_url($item['area'], $item['permission']);
			if (empty($url)) $url = $item['url'];
			// タイトル設定
			$title = mb_strimwidth($item['title'], 0, 50, '...', 'UTF-8');
			if (empty($url)) {
				$res .= '<span title="Menu" class="glyphicon glyphicon-ok-sign"></span>&nbsp;' . $title;
			} else {
				$res .= \Html::anchor($url, '<span title="' . $title . '" class="glyphicon glyphicon-ok-sign"></span>&nbsp;' . $title, array());
			}
			// 説明文の設定
			$res .= empty($item['description']) ? '' : '<span>&nbsp;・・・&nbsp;' . $item['description'] . '</span>';
			// 再帰処理
			if ($item['children']) $res .= self::tree_front_output($item);
			$res .= '</div></li>';
		}
		$res .= '</ul>';
		return $res;
	}

	/**
	 * URLの組み立て
	 *
	 * @param string $area
	 * @param string $permission
	 * @return string
	 */
	public static function get_url($area = '', $permission = '')
	{
		if (empty($area) and empty($area)) {
			$url = '';
		} else {
			if ($area == '/') {
				$url = '/'.$permission;
			} else {
				$url = $area.'/'.$permission;
			}
			// 末尾に/がない場合は付与
			if (substr($url,-1) != '/') $url .= '/';
		}
		return $url;
	}

}

