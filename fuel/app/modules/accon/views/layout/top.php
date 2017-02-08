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
	</div>
</div>