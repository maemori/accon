<div class="container">
	<?php echo Form::open(array("class" => "form-horizontal")); ?>
	<?php echo Form::csrf(); // CSRF 保護 ?>
	<div class="row">
		<div class="col-md-12">
			<h2>パスワードの変更</h2>
			<fieldset class="well">
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
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group btn-group-lg">
				<?php echo Html::anchor(Session::get('return_url'),
					'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
					array('class' => 'btn btn-default')); ?>
				<button type="submit" id="submit" class="btn btn-primary">
					<span title="保存" class="glyphicon glyphicon-save"></span>
				</button>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>
