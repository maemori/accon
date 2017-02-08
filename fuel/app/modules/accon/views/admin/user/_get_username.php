<?php if (!$this->data[ACTION_EDIT]): ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">更新者&nbsp;<span class="badge">ID</span></label>
		<p class="col-md-4 form-control disabled"><?php echo $model->user->username.'&nbsp;<span class="badge">'.$model->user_id.'</span>'; ?></p>
	</div>
<?php endif; ?>
