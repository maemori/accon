<fieldset>
	<?php echo render('foundation/_get_name', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<div class="form-group <?php echo !$val->error('filter') ?: 'has-error' ?>">
		<?php echo Form::label('フィルター', 'filter', array('class' => 'control-label')); ?>
		<?php echo Form::select('filter', Input::post('filter', isset($model) ? $model->filter : DEFAULT_GROUP_ID), $filters, array('class' => 'col-md-4 form-control', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
		<?php if ($val->error('filter')): ?>
			<span class="control-label"><?php echo $val->error('filter')->get_message(); ?></span>
		<?php endif; ?>
	</div>
	<?php if (!$this->data[ACTION_EDIT]): ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">所属グループ&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			if (isset($model)) {
				foreach ($model->groups as $node) {
					// グループ名とそのリンク
					echo Html::anchor(MODULE.'/admin/group/view/'.$node->id,
							'<i class="icon-eye-open"></i>'.$model->name.'&nbsp;<span class="badge">'.$node->id.'</span>',
							array('class' => $view_permissions['group'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled')).'&nbsp;';
				}
			}
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label" for="form_filter">所属ユーザ&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			if (isset($model)) {
				foreach ($model->users as $node) {
					// ユーザ名とそのリンク
					echo Html::anchor(MODULE.'/admin/user/view/'.$node->id,
							'<i class="icon-eye-open"></i>'.$node->username.'&nbsp;<span class="badge">'.$node->id.'</span>',
							array('class' => $view_permissions['user'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled')).'&nbsp;';
				}
			}
			?>
		</div>
	</div>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php endif; ?>
</fieldset>
