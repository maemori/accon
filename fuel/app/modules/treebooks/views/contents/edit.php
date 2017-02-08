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
 * 標準 変更View
 *
 * 個別のレイアウト機能を実装したい場合は、機能のView配置箇所にコピーし内容をカスタマイズ.
 * Controller_CrudのView生成時のstandard_パラメータにfalseを指定.
 */
?>
<div class="container">
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_EDIT, 'active_name' => ACTION_EDIT_NAME)); ?>
	<?php echo Form::open(array('class' => 'form-horizontal')); ?>
	<?php echo Form::csrf(); // CSRF 保護 ?>
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<?php echo render($view_form, array(ACTION_EDIT => true)); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group btn-group-lg">
				<?php
				if (!empty($authority[ACTION_INDEX]) and ((bool)$authority[ACTION_INDEX])) {
					echo Html::anchor(Session::get('return_url'),
						'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
						array('class' => 'btn btn-default'));
				}
				?>
				<?php if (!empty($authority[ACTION_EDIT]) and ((bool)$authority[ACTION_EDIT])) { ?>
				<button type="submit" id="submit" name="<?php echo PROCESSING ?>" class="btn btn-success">
					<span title="保存" class="glyphicon glyphicon glyphicon-saved"></span>
				</button>
				<?php } ?>
				<?php
				if (!empty($authority[ACTION_VIEW]) and ((bool)$authority[ACTION_VIEW])) {
					echo Html::anchor($action_url[ACTION_VIEW] . $model->id,
						'<span title="照会" class="glyphicon glyphicon-eye-open"></span>',
						array('class' => 'btn btn-info'));
				}
				?>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>
