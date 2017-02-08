<div class="container">
	<?php echo \Form::csrf(); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h1><?php echo isset($title) ? $title : ''; ?></h1>
				<h2><?php echo isset($sub_title) ? $sub_title : ''; ?></h2>
				<p><?php echo isset($description) ? $description : ''; ?></p>
			</div>
		</div>
<!--		<div class="col-md-4" style="margin-top: 6px; margin-bottom: 6px; text-align: center;">-->
<!--			--><?php //echo render('layout/rectangle'); ?>
<!--		</div>-->
	</div>
</div>