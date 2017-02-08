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
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_CREATE, 'active_name' => ACTION_CREATE_NAME)); ?>
	<?php echo Form::open(array('action' => $action_url[ACTION_CREATE], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	<?php echo Form::csrf(); // CSRF 保護 ?>
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<?php echo render($view_form, array(ACTION_CREATE => true, ACTION_EDIT => true)); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group btn-group-lg">
				<?php echo Html::anchor(Input::referrer(),
					'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
					array('class' => 'btn btn-default')); ?>
				<button type="submit" id="submit" name="processing" value="<?php echo SUBMIT_CREATE ?>" class="btn btn-primary">
					<span title="保存" class="glyphicon glyphicon-save"></span>
				</button>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>