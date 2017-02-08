<fieldset>
	<div class="form-group <?php echo !$val->error('old_password') ?: 'has-error' ?>">
		<?php echo Form::label('Old password', 'old_password', array('class' => 'control-label')); ?>
		<?php echo Form::password('old_password', Input::post('old_password', isset($old_password) ? $old_password : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Old password')); ?>
		<?php if ($val->error('old_password')): ?>
			<span class="control-label"><?php echo $val->error('old_password')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('new_password') ?: 'has-error' ?>">
		<?php echo Form::label('New password', 'new_password', array('class' => 'control-label')); ?>
		<?php echo Form::password('new_password', Input::post('new_password', isset($old_password) ? $old_password : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'New password')); ?>
		<?php if ($val->error('new_password')): ?>
			<span class="control-label"><?php echo $val->error('new_password')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('verify_password') ?: 'has-error' ?>">
		<?php echo Form::label('Verify password', 'verify_password', array('class' => 'control-label')); ?>
		<?php echo Form::password('verify_password', Input::post('verify_password', isset($verify_password) ? $verify_password : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Verify password')); ?>
		<?php if ($val->error('verify_password')): ?>
			<span class="control-label"><?php echo $val->error('verify_password')->get_message(); ?></span>
		<?php endif; ?>
	</div>
</fieldset>
