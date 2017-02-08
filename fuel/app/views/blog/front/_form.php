<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-md-9">
			<h1><?php echo $model->title ?></h1>
		</div>
		<div class="col-md-3">
			<p class=""><?php echo $model->slug->name ?></p>
			<p class=""><?php echo $model->public_at ?></p>
		</div>
		<div class="col-md-12">
			<?php echo render('layout/rectangle'); ?>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-md-12">
			<p class=""><?php echo $model->summary ?></p>
			<p class="text-right"><?php echo $model->body ?></p>
			<?php echo render('layout/rectangle'); ?>
		</div>
	</div>
</div>

