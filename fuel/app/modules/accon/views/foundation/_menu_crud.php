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
 * メニューCRUD表示部品
 */
?>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<?php
			echo render($view_menu);
			switch ($this->data['active']) {
				case ACTION_INDEX:
					echo '<li class="active"><span class="glyphicon glyphicon-cog"></span>&nbsp;'.$title.'</li>';
					break;
				case ACTION_VIEW:
					echo '<li class="active">'.Html::anchor($action_url[ACTION_INDEX], '<span title="'.ACTION_VIEW_NAME.'" class="glyphicon glyphicon-cog"></span>&nbsp;'.$title).'</li>';
					echo '<li class="active"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;'.$this->data['active_name'].'</li>';
					break;
				case ACTION_EDIT:
					echo '<li class="active">'.Html::anchor($action_url[ACTION_INDEX], '<span title="'.ACTION_VIEW_NAME.'" class="glyphicon glyphicon-cog"></span>&nbsp;'.$title).'</li>';
					echo '<li class="active"><span class="glyphicon glyphicon-pencil"></span>&nbsp;'.$this->data['active_name'].'</li>';
					break;
				case ACTION_CREATE:
					echo '<li class="active">'.Html::anchor($action_url[ACTION_INDEX], '<span title="'.ACTION_VIEW_NAME.'" class="glyphicon glyphicon-cog"></span>&nbsp;'.$title).'</li>';
					echo '<li class="active"><span class="glyphicon glyphicon-plus"></span>&nbsp;'.$this->data['active_name'].'</li>';
					break;
			}
			?>
		</ul>
	</div>
</div>