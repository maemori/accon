<?php echo render(FOUNDATION_VIEW_INDEX_HEADER); // 検索VIEWの標準ヘッダー ?>
<div class="row">
	<div class="col-md-12">
		<?php echo Form::open(array("id" => "search-condition-form", "class" => "form-inline")); ?>
		<?php echo Form::csrf(); // CSRF 保護 ?>
		<div id="search-condition" class="row search-condition-area">
			<div class="col-md-8 search-condition-input-box">
				<div class="col-md-12">
					<?php echo render(FOUNDATION_VIEW_SEARCH_DISPLAY_COUNTS); // 表示件数制御標準部品 ?>
				</div>
				<div class="col-md-4">
					<span class="input-group search-condition-input">
						<span class="input-group-addon">エリア</span>
						<?php echo Form::input('area', isset($view_search['area']) ? $view_search['area'] : '', array('class' => 'form-control')); ?>
					</span>
				</div>
				<div class="col-md-8">
					<span class="input-group search-condition-input search-condition-input-end">
						<span class="input-group-addon">機能</span>
						<?php echo Form::input('permission', isset($view_search['permission']) ? $view_search['permission'] : '', array('class' => 'form-control')); ?>
					</span>
				</div>
			</div>
			<div class="col-md-4">
				<?php echo render(FOUNDATION_VIEW_SEARCH_ACTION); // 検索実行標準部品 ?>
			</div>
		</div>
		<?php echo Form::close(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php if ($model): ?>
			<table class="table table-striped table-hover table-condensed" id="data_table">
				<thead>
				<tr>
					<th class="nowrap">エリア&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">機能</th>
					<th class="nowrap">説明</th>
					<th class="nowrap">アクション</th>
					<th class="nowrap">更新者&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="break-word"><?php echo Html::anchor($item->area.'/', $item->area.'&nbsp;<span class="badge">'.$item->id.'</span>'
								, array('title' => $item->area, 'target' => '_blank')); ?></td>
						<td class="nowrap"><?php echo Html::anchor($item->area.'/'.$item->permission.'/', $item->permission, array('title' => $item->area.'/'.$item->permission, 'target' => '_blank')); ?></td>
						<td class=""><?php echo $item->description; ?></td>
						<td class=""><?php echo $item->actions; ?></td>
						<td class="break-word"><?php echo $item->user->username.'&nbsp;<span class="badge">'.$item->user_id.'</span>'; ?></td>
						<td class="nowrap"><?php echo render(FOUNDATION_VIEW_MODEL_ACTIONS, array(VIEW_ACTION_KEY => $item->id)); // 検索結果モデルアクション標準部品 ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
<?php echo render(FOUNDATION_VIEW_INDEX_FOOTER); // 検索VIEWの標準フッター ?>
<script>
	/**
	 * データテーブルの設定
	 */
	$('#data_table').dataTable({
		"paging": false, // ページング停止
		"info": false,
		"bFilter": false, // 検索機能停止
		"aoColumnDefs": [{"bSortable": false, "aTargets": [5]}] // ソート除外
	});
</script>