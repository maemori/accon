<fieldset>
	<div class="form-group <?php echo !$val->error('username') ?: 'has-error' ?>">
		<?php echo Form::label('名称', 'username', array('class' => 'control-label')); ?>
		<?php echo Form::input('username', Input::post('username', isset($model) ? $model->username : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Username', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('username')): ?>
			<span class="control-label"><?php echo $val->error('username')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php if (isset($this->data[ACTION_CREATE])): ?>
		<div class="form-group <?php echo !$val->error('password') ?: 'has-error' ?>">
			<?php echo Form::label('Password', 'password', array('class' => 'control-label')); ?>
			<?php echo Form::password('password', Input::post('password', isset($model) ? $model->password : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Password')); ?>
			<?php if ($val->error('password')): ?>
				<span class="control-label"><?php echo $val->error('password')->get_message(); ?></span>
			<?php endif; ?>
		</div>
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
	<?php echo render('admin/group/_get_group', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php if (!$this->data[ACTION_EDIT]): ?>
		<div class="form-group">
			<label class="control-label" for="form_filter">最終ログイン</label>
			<p class="col-md-4 form-control disabled"><?php echo !empty($model->last_login) ? Date::time_ago($model->last_login) : ''; ?></p>
		</div>
		<div class="form-group">
			<label class="control-label" for="form_filter">前回ログイン</label>
			<p class="col-md-4 form-control disabled"><?php echo !empty($model->previous_login) ? Date::time_ago($model->previous_login) : ''; ?></p>
		</div>
	<?php endif; ?>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
