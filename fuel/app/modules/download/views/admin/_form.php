<script src="/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY/MM/DD HH:mm'
		})
	});
	$(document).ready(function () {
		CKEDITOR.replace('form_description');
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
	<?php if ($this->data[ACTION_EDIT]): ?>
		<div class="form-group">
			<label class="control-label" for="form_upload_file">アップロード</label>
			<?php echo Form::file(array('id' => 'form_upload_file', 'name' => 'upload_file', 'class' => 'file', 'multiple' => 'true', 'data-show-upload' => 'false', 'data-show-caption' => 'true', 'data-max-file-count' => 1)); ?>
		</div>
	<?php endif; ?>
	<?php if (!empty($model->pass)): ?>
		<div class="form-group">
			<?php echo Form::label('パス', 'pass', array('class' => 'control-label')); ?>
			<?php echo Form::input('pass', Input::post('pass', $model->pass), array('class' => 'col-md-4 form-control', 'disabled')); ?>
		</div>
	<?php endif; ?>
	<?php if (!empty($model->saved_as)): ?>
		<div class="form-group">
			<?php echo Form::label('保存ファイル名', 'saved_as', array('class' => 'control-label')); ?>
			<?php echo Form::input('saved_as', Input::post('saved_as', $model->saved_as), array('class' => 'col-md-4 form-control', 'disabled')); ?>
		</div>
	<?php endif; ?>
	<?php if (!empty($model->name)): ?>
		<div class="form-group">
			<?php echo Form::label('表示ファイル名', 'name', array('class' => 'control-label')); ?>
			<div class="input-group">
				<?php echo Form::input('name', Input::post('name', $model->name), array('class' => 'col-md-4 form-control', 'disabled')); ?>
				<span class="input-group-btn">
					<?php echo Html::anchor('/download/get/'.$model->id, 'DOWNLOAD', array('class' => 'btn btn-info')); ?>
				</span>
			</div>
		</div>
	<?php endif; ?>
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
			<?php echo Form::input('public_at', Input::post('public_at', isset($model) ? $model->public_at : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'public_at', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
		<?php if ($val->error('public_at')): ?>
			<span class="control-label"><?php echo $val->error('public_at')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('description') ?: 'has-error' ?>">
		<?php echo Form::label('説明', 'description', array('class' => 'control-label')); ?>
		<?php echo Form::textarea('description', Input::post('description', isset($model) ? $model->description : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'description', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('description')): ?>
			<span class="control-label"><?php echo $val->error('description')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php if (!$this->data[ACTION_EDIT]): ?>
		<div class="form-group">
			<label class="control-label" for="form_filter">表示回数</label>
			<p class="col-md-4 form-control disabled"><?php echo !empty($model->impressions) ? $model->impressions : 0; ?></p>
		</div>
		<div class="form-group">
			<label class="control-label" for="form_filter">取得回数</label>
			<p class="col-md-4 form-control disabled"><?php echo !empty($model->get_number) ? $model->get_number : 0; ?></p>
		</div>
	<?php endif; ?>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>

