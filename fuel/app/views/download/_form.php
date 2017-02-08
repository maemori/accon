<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<h1><?php echo $model->title ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<p class="text-right">表示回数：<?php echo $model->impressions ?></p>
				<p class="text-right">ダウンロード数：<?php echo $model->get_number ?></p>
				<p class="text-right">公開日時：<?php echo date("Y/m/d H:i", $model->public_at); ?></p>
				<span class="">
					<?php echo Html::anchor('/download/get/'.$model->id, '<span title="Book" class="glyphicon glyphicon-save"></span>&nbsp;ダウンロード', array('class' => 'btn btn-info btn-lg btn-block')); ?>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<p class="text-right"><?php echo $model->description ?></p>
	</div>
	<div class="col-md-12">
		<?php echo render('layout/rectangle'); ?>
	</div>
</div>
