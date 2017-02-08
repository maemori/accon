<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="/"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php echo MENU_HOME; ?></a></li>
				<li><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Download</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo render('download/_list'); ?>
			<div class="pull-right"><?php echo Pagination::instance('pagination')->render(); ?></div>
		</div>
	</div>
</div>
