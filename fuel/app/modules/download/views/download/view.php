<div class="container">
	<?php echo Form::open(array('class' => 'form-horizontal')); ?>
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="/"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php echo MENU_HOME; ?></a></li>
				<li><a href="/download/"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Download</a></li>
				<li><span class="glyphicon glyphicon-save"></span>&nbsp;<?php echo $model->title ?></li>
			</ul>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php echo render($view_form, array(ACTION_EDIT => false)); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group btn-group-lg">
				<?php echo Html::anchor(Session::get('return_url'),
					'<span title="戻る" class="glyphicon glyphicon-arrow-left">',
					array('class' => 'btn btn-default')); ?>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>
</div>