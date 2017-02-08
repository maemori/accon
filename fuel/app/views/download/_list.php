<div class="row">
	<div class="col-md-12">
		<?php if ($model): ?>
			<?php foreach ($model as $item): ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<h2><a class="" href="<?php echo '/download/view/'.$item->id; ?>"><?php echo $item->title ?></a></h2>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<p class="text-right">表示回数：<?php echo $item->impressions ?></p>
										<p class="text-right">ダウンロード数：<?php echo $item->get_number ?></p>
									</div>
									<div class="col-md-12">
										<p class="text-right">公開日時：<?php echo $item->public_at ?></p>
									</div>
								</div>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-md-12">
								<h3><?php echo $item->description ?></h3>
							</div>
						</div>
						<?php echo render('layout/rectangle'); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
