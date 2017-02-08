<div class="container">
	<?php echo Form::open(array('class' => '')); ?>
	<?php echo Form::csrf(); // CSRF 保護 ?>
	<div class="row">
		<div class="col-sm-12">
			<?php if (isset($_GET['destination'])): ?>
				<?php echo Form::hidden('destination', $_GET['destination']); ?>
			<?php endif; ?>
			<?php if (isset($login_error)): ?>
				<div class="alert alert-danger"><span class=""><?php echo $login_error; ?></span></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 form-group <?php echo !$val->error('email') ?: 'has-error' ?>">
			<div class="input-group input-group-lg">
				<span for="email" class="input-group-addon" id="sizing-addon1">アカウント</span>
				<?php echo Form::input('email', isset($email) ? $email : '', array('class' => 'form-control input-lg', 'placeholder' => 'Email or Username', 'autofocus')); ?>
			</div>
			<?php if ($val->error('email')): ?>
				<div class="control-label"><?php echo $val->error('email')->get_message(':labelを入力してください'); ?></div>
			<?php endif; ?>
		</div>
		<div class="col-sm-4 form-group <?php echo !$val->error('password') ?: 'has-error' ?>">
			<div class="input-group input-group-lg">
				<span for="password" class="input-group-addon" id="sizing-addon1">パスワード</span>
				<?php echo Form::password('password', isset($password) ? $password : '', array('class' => 'form-control input-lg', 'placeholder' => 'Password')); ?>
			</div>
			<?php if ($val->error('password')): ?>
				<span
					class="control-label"><?php echo $val->error('password')->get_message(':labelを入力してください'); ?></span>
			<?php endif; ?>
		</div>
		<div class="col-sm-4 actions">
			<?php echo Form::submit(array('value' => 'Login', 'name' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>
