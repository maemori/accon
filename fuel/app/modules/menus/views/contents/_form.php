<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY/MM/DD HH:mm'
		})
	});
</script>
<fieldset>
	<div class="form-group <?php echo !$val->error('title') ?: 'has-error' ?>">
		<?php echo Form::label('タイトル', 'title', array('class' => 'control-label')); ?>
		<?php echo Form::input('title', Input::post('title', isset($model) ? $model->title : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'title', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('title')): ?>
			<span class="control-label"><?php echo $val->error('title')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('status') ?: 'has-error' ?>">
		<?php echo Form::label('ステータス', 'status', array('class' => 'control-label')); ?>
		<?php echo Form::select('status', Input::post('status', isset($model) ? $model->status : ''), $status, array('class' => 'col-md-4 form-control', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('status')): ?>
			<span class="control-label"><?php echo $val->error('status')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('public_at') ?: 'has-error' ?>">
		<?php echo Form::label('公開日時', 'public_at', array('class' => 'control-label ')); ?>
		<div class='input-group date' id='datetimepicker1'>
			<?php echo Form::input('public_at', Input::post('public_at', isset($model) ? $model->public_at : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'YYYY/MM/DD HH:MM', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
		<?php if ($val->error('public_at')): ?>
			<span class="control-label"><?php echo $val->error('public_at')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('admin/permission/_get_permission', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<div class="form-group <?php echo !$val->error('url') ?: 'has-error' ?>">
		<?php echo Form::label('URL', 'url', array('class' => 'control-label')); ?>
		<?php echo Form::input('url', Input::post('url', is_null($model->url) ? '' : $model->url), array('rows' => '10', 'class' => 'col-md-4 form-control', 'placeholder' => 'http:// or https://', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('url')): ?>
			<span class="control-label"><?php echo $val->error('url')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('description') ?: 'has-error' ?>">
		<?php echo Form::label('説明', 'description', array('class' => 'control-label')); ?>
		<?php echo Form::textarea('description', Input::post('description', isset($model) ? $model->description : ''), array('rows' => '10', 'class' => 'col-md-4 form-control', 'placeholder' => 'description', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('description')): ?>
			<span class="control-label"><?php echo $val->error('description')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>

