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
	<div class="form-group <?php echo !$val->error('sort') ?: 'has-error' ?>">
		<?php echo Form::label('表示順', 'sort', array('class' => 'control-label')); ?>
		<?php echo Form::input('sort', Input::post('area', isset($model->menu->sort) ? $model->menu->sort : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Sort', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('sort')): ?>
			<span class="control-label"><?php echo $val->error('sort')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<?php echo Form::label('Top表示&nbsp;', 'top_display_flag'); ?>
		<?php echo Form::checkbox('top_display_flag', Input::post('top_display_flag', isset($model->menu->top_display_flag) ? $model->menu->top_display_flag : 0), 0, array('class' => '', 'placeholder' => 'top_display_flag', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
	</div>
	<div class="form-group <?php echo !$val->error('permission') ?: 'has-error' ?>">
		<?php echo Form::label('公開名', 'permission', array('class' => 'control-label')); ?>
		<?php echo Form::input('permission', Input::post('permission', isset($model->permission->permission) ? $model->permission->permission : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Permission', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('permission')): ?>
			<span class="control-label"><?php echo $val->error('permission')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('description') ?: 'has-error' ?>">
		<?php echo Form::label('説明', 'description', array('class' => 'control-label')); ?>
		<?php echo Form::textarea('description', Input::post('description', isset($model) ? $model->description : ''), array('rows' => '6', 'class' => 'col-md-4 form-control', 'placeholder' => 'description', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('description')): ?>
			<span class="control-label"><?php echo $val->error('description')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>

