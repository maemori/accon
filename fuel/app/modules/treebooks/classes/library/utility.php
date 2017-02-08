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

namespace Treebooks;

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
			echo \Html::anchor('/treebooks/contents/?id='.$items['id'],
				'<div class="text-left"><span title="Book" class="glyphicon glyphicon-book"></span>&nbsp;'.
					mb_strimwidth($items['title'], 0, 16, '...', 'UTF-8' ).'</div>',
				array('class' => $style));
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
					echo \Html::anchor('/treebooks/contents/?id='.$item['id'],
						'<div class="text-left"><span title="Book" class="glyphicon glyphicon-list"></span>&nbsp;'.
							mb_strimwidth($item['title'], 0, 16, '...', 'UTF-8' ).'</div>',
						array('class' => $style));
				} else {
					echo \Html::anchor('/treebooks/contents/?id='.$item['id'],
						'<div class="text-left"><span title="Book" class="glyphicon glyphicon-list-alt"></span>&nbsp;'.
							mb_strimwidth($item['title'], 0, 16, '...', 'UTF-8' ).'</div>',
						array('class' => $style));
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
	 * @param int $this_id
	 * @param null $items
	 */
	public static function tree_front_output($base_url_pass = '', $this_id = 0, $items = null){
		echo '<ul class="tree">';
		echo '<li>';
		if (!empty($items)) {
			if ($this_id == $items['id']) {
				$style = 'glyphicon-eye-open';
				$child_view = true;
			} else {
				$style = 'glyphicon-book';
				$child_view = false;
			}
			echo \Html::anchor($base_url_pass.'/?id='.$items['id'],
				'<div class="text-left"><h3><span title="Book" class="glyphicon '.$style.'"></span>&nbsp;'.
				mb_strimwidth($items['title'], 0, 16, '...', 'UTF-8' ).'</h3></div>');
			self::tree_front_children($base_url_pass, $this_id, $items, $child_view);
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
	public static function tree_front_children($base_url_pass = '', $this_id = 0, $items = null, $child_view = false){
		echo '<ul>';
		$child_view_flg = $child_view;
		$child_view = false; // 1階層下を表示
		foreach ($items['children'] as $item){
			if (isset($item['children'])) {
				if ($this_id == $item['id']) {
					$head = 'h4';
					$style = 'glyphicon-eye-open';
					$child_view = true;
					$text_color = '';
				} elseif ($child_view_flg){
					$head = 'h4';
					$style = 'glyphicon-triangle-right';
					$text_color = '';
				} else {
					$head = 'h4';
					$style = '';
					$text_color = 'tree-menu-txt';
				}
				echo '<li>';
				echo \Html::anchor($base_url_pass.'/?id='.$item['id'],
					'<div class="text-left '.$text_color.'"><'.$head.'><span title="Book" class="glyphicon '.$style.'"></span>'.
					mb_strimwidth($item['title'], 0, 16, '...', 'UTF-8' ).'</'.$head.'></div>');
				self::tree_front_children($base_url_pass, $this_id, $item, $child_view);
				echo '</li>';
			}
			if ($child_view) {
				$child_view = false;
			}
		}
		echo '</ul>';
	}

}