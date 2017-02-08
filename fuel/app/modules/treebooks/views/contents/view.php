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
 * 標準 照会View
 *
 * 個別のレイアウト機能を実装したい場合は、機能のView配置箇所にコピーし内容をカスタマイズ.
 * Controller_CrudのView生成時のstandard_パラメータにfalseを指定.
 */
?>
<div class="container">
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_VIEW, 'active_name' => ACTION_VIEW_NAME)); ?>
	<?php echo Form::open(array('class' => 'form-horizontal')); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<?php echo render($view_form, array(ACTION_EDIT => false)); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 btn-group btn-group-lg">
			<?php
			if (!empty($authority[ACTION_INDEX]) and ((bool)$authority[ACTION_INDEX])) {
				echo Html::anchor(Session::get('return_url'),
					'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
					array('class' => 'btn btn-default'));
			}
			if (!empty($authority[ACTION_EDIT]) and ((bool)$authority[ACTION_EDIT])) {
				echo Html::anchor($action_url[ACTION_EDIT] . $model->id,
					'<span title="変更" class="glyphicon glyphicon-pencil"></span>',
					array('class' => 'btn btn-success'));
			}
			?>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>
