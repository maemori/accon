<fieldset>
	<div class="form-group <?php echo !$val->error('name') ?: 'has-error' ?>">
		<?php echo Form::label('名前', 'name', array('class' => 'control-label')); ?>
		<?php echo Form::input('name', Input::post('name', isset($model) ? $model->name : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'name', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('name')): ?>
			<span class="control-label"><?php echo $val->error('name')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
