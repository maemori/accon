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
 * 検索アクション標準部品
 */
?>
<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
	<div class="btn-group btn-group-lg search-condition-btn">
		<button type="submit" id="submit" name="processing" value="<?php echo SUBMIT_SEARCH ?>" class="btn btn-info">
			<span title="検索" class="glyphicon glyphicon-search">
				<?php echo isset($view_control['total_items']) ? '<span class="badge">' . $view_control['total_items'] . '</span>' : '' ?>
			</span>
		</button>
		<button type="submit" name="processing" value="<?php echo SUBMIT_BACK ?>" class="btn btn-default">
			<span title="前の検索" class="glyphicon glyphicon-repeat">
				<?php echo isset($view_control['search_count']) ? '<span class="badge">' . $view_control['search_count'] . '</span>' : '' ?>
			</span>
		</button>
		<button type="submit" name="processing" value="<?php echo SUBMIT_RESET ?>" class="btn btn-default">
			<span title="リセット" class="glyphicon glyphicon-erase"></span>
		</button>
	</div>
	<div class="btn-group btn-group-lg search-condition-btn">
		<?php
		if ((bool)$authority[ACTION_CREATE]) {
			echo '<button type="submit" name="processing" value="' . SUBMIT_ADD . '" class="btn btn-warning">' .
				'<span title="' . ACTION_CREATE_NAME . '" class="glyphicon glyphicon-plus"></span></button>';
		}
		?>
	</div>
</div>