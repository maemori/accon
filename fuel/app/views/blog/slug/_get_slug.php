<?php if ($this->data[ACTION_EDIT]): ?>
	<div class="form-group <?php echo !$val->error('slug_id') ?: 'has-error' ?>">
		<?php echo Form::label('スラッグ', 'slug_id', array('class' => 'control-label')); ?>
		<?php echo Form::select('slug_id', Input::post('group_id', isset($model) ? $model->slug_id : ''), $slug_list, array('class' => 'col-md-4 form-control')); ?>
		<?php if ($val->error('slug_id')): ?>
			<span class="control-label"><?php echo $val->error('slug_id')->get_message(); ?></span>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">スラッグ&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			// Slug名とそのリンク
			echo Html::anchor('/blog/slug/view/'.$model->slug_id,
				'<i class="icon-eye-open"></i>'.$model->slug->name.'&nbsp;<span class="badge">'.$model->slug_id.'</span>',
				array('class' => $view_permissions['slug'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled')).'&nbsp;';
			?>
		</div>
	</div>
<?php endif; ?>
