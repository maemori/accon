<?php echo render(FOUNDATION_VIEW_INDEX_HEADER); // 検索VIEWの標準ヘッダー ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php echo render('blog/front/_list'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="btn-group btn-group-lg">
				<a class="btn btn-default" href="/"><span title="戻る" class="glyphicon glyphicon-arrow-left"></span></a>
			</div>
		</div>
		<div class="col-md-6">
			<div class="pull-right"><?php echo Pagination::instance('pagination')->render(); ?></div>
		</div>
	</div>
</div>
