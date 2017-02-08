<div class="row">
	<div class="col-md-12">
		<?php if ($model): ?>
			<?php foreach ($model as $item): ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
							<div class="col-md-9">
								<h1><a class="" href="<?php echo '/blog/front/view/'.$item->id; ?>"><?php echo $item->title ?></a></h1>
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-12">
										<p class="text-right"><?php echo $item->public_at ?></p>
									</div>
									<div class="col-md-12">
										<div class="pull-right">
										<?php
											if (!empty($item->body)) {
												echo Html::anchor('/blog/front/view/'.$item->id,
													'<span title="'.$item->title.'" class="glyphicon glyphicon-eye-open">',
													array('class' => 'btn btn-info btn-lg'));
											}
										?>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-md-12">
								<h3><?php echo $item->summary ?></h3>
							</div>
						</div>
						<?php echo render('layout/rectangle'); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
