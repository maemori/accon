<?php if ($this->data[ACTION_EDIT]): ?>
	<div class="form-group <?php echo !$val->error('perms_id') ?: 'has-error' ?>">
		<?php echo Form::label('パーミッション（エリア+機能）', 'perms_id', array('class' => 'control-label')); ?>
		<?php echo Form::select('perms_id', Input::post('perms_id', isset($model) ? $model->perms_id : ''), $permission_list, array('class' => 'col-md-4 form-control')); ?>
		<?php if ($val->error('perms_id')): ?>
			<span class="control-label"><?php echo $val->error('perms_id')->get_message(); ?></span>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="form-group">
		<label class="control-label" for="form_filter">パーミッション（エリア．機能）&nbsp;<span class="badge">ID</span></label>
		<div class="form-group">
			<?php
			// エリア名とそのリンク
			if (isset($model->permission->area)) {
				if ($model->permission->area == '/') {
					$url = '/'.$model->permission->permission;
				} else {
					$url = $model->permission->area.'/'.$model->permission->permission;
				}
				echo Html::anchor('Accon/admin/permission/view/'.$model->perms_id,
					'<i class="icon-eye-open"></i>'.$url.'&nbsp;<span class="badge">'.$model->perms_id.'</span>',
					array('class' => $view_permissions['permission'] ? 'btn btn-info' : 'btn btn-info disabled'));
			}
			?>
		</div>
	</div>
<?php endif; ?>
<div class="form-group">
	<label class="control-label" for="form_filter">パーミッション側のアクション定義内容</label>
	<p id="permission-action" class="col-md-4 form-control disabled">
		<?php echo isset($model->permission->actions) ? $model->permission->actions : ''; ?>
	</p>
</div>
<script>
	/**
	 * エリア名からそのパーミッションリストを取得
	 */
	$(document).ready(function () {
		$("#form_perms_id").change(function () {
			$.ajax({
				type: "POST",
				url: "/accon/ajax/admin/permission/action.json",
				dataType: 'json',
				data: "key=" + $("#form_perms_id").val()
			}).success(function (response) {
				console.log(response);
				$('#permission-action').text(response);
				$('#error_message').empty();
			}).error(function (response) {
				var obj = JSON.parse(response["responseText"]);
				$('#error_message').empty();
				$('#error_message').append('<div class="alert alert-danger"><span class="">' + obj["error"] + '</span></div>');
			});
		});
	});
</script>