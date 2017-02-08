<fieldset>
	<div class="form-group <?php echo !$val->error('area') ?: 'has-error' ?>">
		<?php echo Form::label('エリア', 'area', array('class' => 'control-label')); ?>
		<?php if ($this->data['edit']): ?>
			<?php echo Form::input('area', Input::post('area', isset($model) ? $model->area : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Area')); ?>
			<?php if ($val->error('area')): ?>
				<span class="control-label"><?php echo $val->error('area')->get_message(); ?></span>
			<?php endif; ?>
		<?php else: ?>
			<p class="col-md-4 form-control disabled"><?php echo isset($model) ? Html::anchor($model->area.'/', $model->area, array('title' => $model->area, 'target' => '_blank')) : ''; ?></p>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('permission') ?: 'has-error' ?>">
		<?php echo Form::label('機能', 'permission', array('class' => 'control-label')); ?>
		<?php if ($this->data['edit']): ?>
			<?php echo Form::input('permission', Input::post('permission', isset($model) ? $model->permission : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Permission')); ?>
			<?php if ($val->error('permission')): ?>
				<span class="control-label"><?php echo $val->error('permission')->get_message(); ?></span>
			<?php endif; ?>
		<?php else: ?>
			<p class="col-md-4 form-control disabled"><?php echo isset($model) ? Html::anchor($model->area.'/'.$model->permission.'/', $model->permission, array('title' => $model->area.'/'.$model->permission, 'target' => '_blank')) : ''; ?></p>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('description') ?: 'has-error' ?>">
		<?php echo Form::label('説明', 'description', array('class' => 'control-label')); ?>
		<?php echo Form::input('description', Input::post('description', isset($model) ? $model->description : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Description', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('description')): ?>
			<span class="control-label"><?php echo $val->error('description')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<div class="form-group <?php echo !$val->error('actions') ?: 'has-error' ?>">
		<?php echo Form::label('アクション&nbsp;（「,」区切りで指定）', 'actions', array('class' => 'control-label')); ?>
		<?php echo Form::input('actions', Input::post('actions', isset($model) ? $model->actions : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Actions', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('actions')): ?>
			<span class="control-label"><?php echo $val->error('actions')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php if (!$this->data['edit']): ?>
		<div class="form-group">
			<label class="control-label" for="form_filter">更新者&nbsp;<span class="badge">ID</span></label>
			<p class="col-md-4 form-control disabled"><?php echo $model->user->username.'&nbsp;<span class="badge">'.$model->user_id.'</span>'; ?></p>
		</div>
	<?php endif; ?>
</fieldset>
