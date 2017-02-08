<div class="form-group <?php echo !$val->error('actions') ?: 'has-error' ?>">
	<?php echo Form::label('アクション&nbsp;（「,」区切りで指定）', 'actions', array('class' => 'control-label')); ?>
	<?php echo Form::input('actions', Input::post('actions', isset($model) ? $model->actions : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Actions', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
	<?php if ($val->error('actions')): ?>
		<span class="control-label"><?php echo $val->error('actions')->get_message(); ?></span>
	<?php endif; ?>
</div>