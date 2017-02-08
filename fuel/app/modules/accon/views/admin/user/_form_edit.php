<fieldset>
	<div class="form-group <?php echo !$val->error('username') ?: 'has-error' ?>">
		<?php echo Form::label('名称', 'username', array('class' => 'control-label')); ?>
		<?php echo Form::input('username', Input::post('username', isset($model) ? $model->username : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Username', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('username')): ?>
			<span class="control-label"><?php echo $val->error('username')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php if (isset($this->data[ACTION_CREATE])): ?>
		<div class="form-group <?php echo !$val->error('verify_password') ?: 'has-error' ?>">
			<?php echo Form::label('Verify password', 'Verify password', array('class' => 'control-label')); ?>
			<?php echo Form::password('verify_password', Input::post('verify_password', isset($verify_password) ? $verify_password : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Verify password')); ?>
			<?php if ($val->error('verify_password')): ?>
				<span class="control-label"><?php echo $val->error('verify_password')->get_message(); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="form-group <?php echo !$val->error('email') ?: 'has-error' ?>">
		<?php echo Form::label('メール', 'email', array('class' => 'control-label')); ?>
		<?php echo Form::input('email', Input::post('email', isset($model) ? $model->email : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Email', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('email')): ?>
			<span class="control-label"><?php echo $val->error('email')->get_message(); ?></span>
		<?php endif; ?>
	</div>
</fieldset>
