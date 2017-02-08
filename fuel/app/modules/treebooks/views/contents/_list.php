<div class="row">
	<div class="col-md-12">
		<?php if ($model): ?>
			<table class="table table-striped table-hover table-condensed" id="data_table">
				<thead>
				<tr>
					<th class=""><span title="Book" class="glyphicon glyphicon-list"></span></th>
					<th class="">タイトル&nbsp;<span class="badge">ID</span></th>
					<th class="">ステータス</th>
					<th class="">公開日時</th>
					<th class="">更新者</th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="">
							<?php
								if ( $first_child_id == $item->id ) {
									$first_child = true;
								} else {
									$first_child = false;
								}
								if ( $last_child_id == $item->id ) {
									$last_child = true;
								} else {
									$last_child = false;
								}
								echo Html::anchor('/treebooks/contents/parent?id='.$item->id,
									'<span title="親へ" class="glyphicon glyphicon glyphicon-arrow-left">',
									array('class' => 'btn btn-default', $root_children ? 'disabled' : ''));
								echo Html::anchor('/treebooks/contents/up?id='.$item->id,
									'<span title="上へ" class="glyphicon glyphicon glyphicon-arrow-up">',
									array('class' => 'btn btn-default', $first_child ? 'disabled' : ''));
								echo Html::anchor('/treebooks/contents/down?id='.$item->id,
									'<span title="下へ" class="glyphicon glyphicon glyphicon-arrow-down">',
									array('class' => 'btn btn-default', $last_child ? 'disabled' : ''));
								echo Html::anchor('/treebooks/contents/child?id='.$item->id,
									'<span title="子へ" class="glyphicon glyphicon glyphicon-arrow-right">',
									array('class' => 'btn btn-default', $first_child ? 'disabled' : ''));
							?>
						</td>
						<td class="">
							<?php
								if ($item->is_leaf()) {
									$icon = '<span title="item-'.$item->id.'" class="glyphicon glyphicon-list-alt"></span>&nbsp;';
								} else {
									$icon = '<span title="item-'.$item->id.'" class="glyphicon glyphicon-list"></span>&nbsp;';
								}
								echo Html::anchor('/treebooks/contents/?id='.$item->id,
									'<div class="text-left">'.$icon.mb_strimwidth($item->title, 0, 14, "...", "UTF-8" )
									.'&nbsp;<span class="badge">'.$item->id.'</span>'.'</div>',
									array('class' => 'btn btn-sm btn-primary btn-block'));
							?>
						</td>
						<td class=""><?php echo $status[$item->status]; ?></td>
						<td class=""><?php echo $item->public_at; ?></td>
						<td class=""><?php echo $item->user->username.'&nbsp;<span class="badge">'.$item->user_id.'</span>'; ?></td>
						<td class="nowrap"><?php echo render(FOUNDATION_VIEW_MODEL_ACTIONS, array(VIEW_ACTION_KEY => $item->id)); // 検索結果モデルアクション標準部品 ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
<script>
	/**
	 * データテーブルの設定
	 */
	$('#data_table').dataTable({
		"order": false,
		"paging": false, // ページング停止
		"info": false,
		"bFilter": false, // 検索機能停止
		"aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}] // ソート除外
	});
</script>