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
 * 検索結果モデルアクション標準部品
 */
?>
<div class="pull-right btn-group">
	<?php
	if ((bool)$authority[ACTION_VIEW]) {
		echo Html::anchor($action_url[ACTION_VIEW] . $this->data[VIEW_ACTION_KEY],
			'<span title="' . ACTION_VIEW_NAME . '" class="glyphicon glyphicon-eye-open"></span>',
			array('class' => 'btn btn-info'));
	}
	if ((bool)$authority[ACTION_EDIT]) {
		echo Html::anchor($action_url[ACTION_EDIT] . $this->data[VIEW_ACTION_KEY],
			'<span title="' . ACTION_EDIT_NAME . '" class="glyphicon glyphicon-pencil">',
			array('class' => 'btn btn-success'));
	}
	if ((bool)$authority[ACTION_DELETE]) {
		echo Html::anchor($action_url[ACTION_DELETE] . $this->data[VIEW_ACTION_KEY],
			'<span title="' . ACTION_DELETE_NAME . '" class="glyphicon glyphicon-remove">',
			array('class' => 'btn btn-danger',
				'onclick' => "return confirm('削除しますか?')"));
	}
	?>
</div>