<?php if ($this->data[ACTION_EDIT]): ?>
	<div class="form-group <?php echo !$val->error('user_id') ?: 'has-error' ?>">
		<?php echo Form::label('ユーザ', 'user_id', array('class' => 'control-label')); ?>
		<?php echo Form::select('user_id', Input::post('user_id', isset($model) ? $model->user_id : ''), $user_list,
			array('class' => 'col-md-4 form-control')); ?>
		<?php if ($val->error('user_id')): ?>
			<span class="control-label"><?php echo $val->error('user_id')->get_message(); ?></span>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">ユーザ&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			// ユーザ名とそのリンク
			echo Html::anchor(MODULE.'/admin/user/view/'.$model->user_id,
				'<i class="icon-eye-open"></i>'.$model->user->username.'&nbsp;<span class="badge">'.$model->user_id.'</span>',
				array('class' => 'btn btn-info'));
			?>
		</div>
	</div>
<?php endif; ?>
