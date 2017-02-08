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
			echo Html::anchor('/treebooks/slug/view/'.$model->slug_id,
				'<i class="icon-eye-open"></i>'.$model->slug->name.'&nbsp;<span class="badge">'.$model->slug_id.'</span>',
				array('class' => $view_permissions['slug'] ? 'btn btn-info' : 'btn btn-info disabled'));
			?>
		</div>
	</div>
<?php endif; ?>
<div class="form-group <?php echo !$val->error('area') ?: 'has-error' ?>">
	<?php echo Form::label('URL&nbsp;(Area)&nbsp;', 'area', array('class' => 'control-label')); ?>
	<?php echo Form::input('area', Input::post('area', isset($model->permission->area) ? $model->permission->area : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Area', 'disabled')); ?>
	<?php if ($val->error('area')): ?>
		<span class="control-label"><?php echo $val->error('area')->get_message(); ?></span>
	<?php endif; ?>
</div>
<script>
	/**
	 * エリア名からそのパーミッションリストを取得
	 */
	$(document).ready(function () {
		$("#form_slug_id").change(function () {
			$.ajax({
				type: "GET",
				url: "/treebooks/ajax/slug/area.json",
				dataType: 'json',
				data: "key=" + $("#form_slug_id").val()
			}).success(function(response){
//				console.log('Ajax:');
//				console.log(response);
				$('#form_area').attr('value',response);
				$('#error_message').empty();
			}).error(function(response){
				var obj = JSON.parse(response["responseText"]);
				$('#error_message').empty();
				$('#error_message').append('<div class="alert alert-danger"><span class="">'+obj["error"]+'</span></div>');
			});
		});
	});
</script>