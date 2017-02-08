<?php if ($this->data[ACTION_EDIT]): ?>
	<div class="form-group <?php echo !$val->error('group_id') ?: 'has-error' ?>">
		<?php echo Form::label('グループ', 'group_id', array('class' => 'control-label')); ?>
		<?php echo Form::select('group_id', Input::post('group_id', isset($model) ? $model->group_id : ''), $group_list, array('class' => 'col-md-4 form-control')); ?>
		<?php if ($val->error('group_id')): ?>
			<span class="control-label"><?php echo $val->error('group_id')->get_message(); ?></span>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">グループ&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			// グループ名とそのリンク
			echo Html::anchor(MODULE.'/admin/group/view/'.$model->group_id,
				'<i class="icon-eye-open"></i>'.$model->group->name.'&nbsp;<span class="badge">'.$model->group_id.'</span>',
				array('class' => $view_permissions['group'] ? 'btn btn-info' : 'btn btn-info disabled'));
			?>
		</div>
	</div>
<?php endif; ?>
