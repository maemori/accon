<script src="/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY/MM/DD HH:mm'
		})
	});
	$(document).ready(function(){
		CKEDITOR.replace('form_summary');
		CKEDITOR.replace('form_body');
	});
</script>
<fieldset>
	<div class="form-group <?php echo !$val->error('title') ?: 'has-error' ?>">
		<?php echo Form::label('タイトル', 'title', array('class' => 'control-label')); ?>
		<?php echo Form::input('title', Input::post('title', isset($model) ? $model->title : ''),
			array('class' => 'col-md-4 form-control', 'placeholder' => 'title', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('title')): ?>
			<span class="control-label"><?php echo $val->error('title')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('blog/slug/_get_slug', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<div class="form-group <?php echo !$val->error('post_status') ?: 'has-error' ?>">
		<?php echo Form::label('ステータス', 'post_status', array('class' => 'control-label')); ?>
		<?php echo Form::select('post_status', Input::post('post_status', isset($model) ? $model->post_status : ''),
			$status, array('class' => 'col-md-4 form-control', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('post_status')): ?>
			<span class="control-label"><?php echo $val->error('post_status')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('public_at') ?: 'has-error' ?>">
		<?php echo Form::label('公開日時', 'public_at', array('class' => 'control-label ')); ?>
		<div class='input-group date' id='datetimepicker1'>
			<?php echo Form::input('public_at', Input::post('public_at', isset($model) ? $model->public_at : ''),
				array('class' => 'col-md-4 form-control', 'placeholder' => 'public_at', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
		<?php if ($val->error('public_at')): ?>
			<span class="control-label"><?php echo $val->error('public_at')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('summary') ?: 'has-error' ?>">
		<?php echo Form::label('サマリー', 'summary', array('class' => 'control-label')); ?>
		<?php echo Form::textarea('summary', Input::post('summary', isset($model) ? $model->summary : ''),
			array('class' => 'col-md-4 form-control', 'placeholder' => 'summary', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('summary')): ?>
			<span class="control-label"><?php echo $val->error('summary')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('body') ?: 'has-error' ?>">
		<?php echo Form::label('本文', 'body', array('class' => 'control-label')); ?>
		<?php echo Form::textarea('body', Input::post('body', isset($model) ? $model->body : ''),
			array('class' => 'col-md-4 form-control', 'placeholder' => 'body', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('body')): ?>
			<span class="control-label"><?php echo $val->error('body')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
