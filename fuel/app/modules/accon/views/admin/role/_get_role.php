<?php if ($this->data[ACTION_EDIT]): ?>
	<div class="form-group <?php echo !$val->error('role_id') ?: 'has-error' ?>">
		<?php echo Form::label('ロール', 'role_id', array('class' => 'control-label')); ?>
		<?php echo Form::select('role_id', Input::post('role_id', isset($model) ? $model->role_id : ''), $role_list, array('class' => 'col-md-4 form-control')); ?>
		<?php if ($val->error('role_id')): ?>
			<span class="control-label"><?php echo $val->error('role_id')->get_message(); ?></span>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">ロール&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			// ロール名とそのリンク
			echo Html::anchor(MODULE.'/admin/role/view/'.$model->role_id,
				'<i class="icon-eye-open"></i>'.$model->role->name.'&nbsp;<span class="badge">'.$model->role_id.'</span>',
				array('class' => 'btn btn-info'));
			?>
		</div>
	</div>
<?php endif; ?>
