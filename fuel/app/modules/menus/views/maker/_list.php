<div class="row">
	<div class="col-md-12">
		<?php if ($model): ?>
			<table class="table table-striped table-hover table-condensed" id="data_table">
				<thead>
				<tr>
					<th class="nowrap">タイトル&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">ステータス</th>
					<th class="">公開日時</th>
					<th class="nowrap">Top</th>
					<th class="nowrap">表示順</th>
					<th class="">パーミッションURL</th>
					<th class="">概要</th>
					<th class="nowrap">更新者</th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="">
							<?php echo Html::anchor('/menus/contents/?id='.$item->id,
								'<div class="text-left"><span title="Book" class="glyphicon glyphicon-th-list"></span>&nbsp;'.mb_strimwidth($item->title, 0, 40, "...", "UTF-8")
								.'&nbsp;<span class="badge">'.$item->id.'</span>'.'</div>',
								array('class' => 'btn btn-sm btn-primary btn-block')); ?>
						</td>
						<td class="nowrap"><?php echo $status[$item->status]; ?></td>
						<td class=""><?php echo $item->public_at; ?></td>
						<td class="nowrap"><?php echo ($item->menu->top_display_flag) ? '表示' : ''; ?></td>
						<td class="nowrap"><?php echo $item->menu->sort; ?></td>
						<td class="nowrap">
							<?php
							// エリア+機能とそのリンク
							if (isset($item->permission->area)) {
								if ($item->permission->area == '/') {
									$url = '/'.$item->permission->permission;
								} else {
									$url = $item->permission->area.'/'.$item->permission->permission;
								}
								echo Html::anchor(MODULE.'/admin/permission/view/'.$item->perms_id,
									'<i class="icon-eye-open"></i> '.$url.'&nbsp;<span class="badge">'.$item->perms_id.'</span>',
									array('class' => $view_permissions['permission'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled'));
							}
							?>
						</td>
						<td class=""><?php echo mb_strimwidth(strip_tags($item->description), 0, 100, "...", "UTF-8"); ?></td>
						<td class="nowrap"><?php echo $item->user->username.'&nbsp;<span class="badge">'.$item->user_id.'</span>'; ?></td>
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
		"order": [[4, 'asc']],
		"paging": false, // ページング停止
		"info": false,
		"bFilter": false, // 検索機能停止
		"aoColumnDefs": [{"bSortable": false, "aTargets": [8]}] // ソート除外
	});
</script>