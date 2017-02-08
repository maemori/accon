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

?>
<div class="container">
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_EDIT, 'active_name' => ACTION_EDIT_NAME)); ?>
	<?php echo Form::open(array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
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
				<?php echo Html::anchor(Session::get('return_url'),
					'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
					array('class' => 'btn btn-default')); ?>
				<button type="submit" id="submit" class="btn btn-primary">
					<span title="保存" class="glyphicon glyphicon-save"></span>
				</button>
				<?php echo Html::anchor($action_url[ACTION_VIEW].$model->id,
					'<span title="照会" class="glyphicon glyphicon-eye-open"></span>', array('class' => 'btn btn-info')); ?>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>
