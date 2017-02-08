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
						<span class="input-group-addon">名称</span>
						<?php echo Form::input('name', isset($view_search['name']) ? $view_search['name'] : '', array('class' => 'form-control')); ?>
					</span>
				</div>
				<div class="col-md-8">
					<span class="input-group search-condition-input-end">
						<span class="input-group-addon">フィルター</span>
						<?php echo Form::select('filter', isset($view_search['filter']) ? $view_search['filter'] : '', $filters, array('class' => 'form-control')); ?>
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
					<th class="nowrap">名称&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">フィルター</th>
					<th class="">所属グループ</th>
					<th class="nowrap">所属ユーザ</th>
					<th class="nowrap">更新者&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="break-word"><?php echo $item->name.'&nbsp;<span class="badge">'.$item->id.'</span>'; ?></td>
						<td class=""><?php echo $filters[$item->filter]; ?></td>
						<td>
							<?php
							foreach ($item->groups as $group) {
								// グループ名とそのリンク
								echo Html::anchor(MODULE.'/admin/group/view/'.$group->id,
										'<i class="icon-eye-open"></i>'.$group->name,
										array('class' => $view_permissions['group'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled')).'&nbsp;';
							}
							?>
						</td>
						<td>
							<?php
							foreach ($item->users as $user) {
								// ユーザ名とそのリンク
								echo Html::anchor(MODULE.'/admin/user/view/'.$user->id,
										'<i class="icon-eye-open"></i>'.$user->username,
										array('class' => $view_permissions['user'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled')).'&nbsp;';
							}
							?>
						</td>
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