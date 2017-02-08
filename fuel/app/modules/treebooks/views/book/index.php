<div class="container">
	<?php echo render($view_menu); ?>
	<div class="row">
		<div class="col-md-9">
			<h1 class="book-head"><?php echo isset($entry) ? $entry->title : ''; ?></h1>
			<?php echo render('book/_pager'); ?>
			<div class="panel panel-default">
				<div class="book-body panel-body">
					<?php echo \Markdown::parse(isset($entry) ? $entry->content : ''); ?>
				</div>
			</div>
			<?php echo render('book/_pager'); ?>
			<?php echo render('book/_list'); ?>
		</div>
		<div class="col-md-3">
			<?php echo render('book/_tree'); ?>
		</div>
	</div>
</div>
