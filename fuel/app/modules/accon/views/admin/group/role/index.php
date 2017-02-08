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
						<span class="input-group-addon">グループ</span>
						<?php echo Form::select('group_id', isset($view_search['group_id']) ? $view_search['group_id'] : "", $group_list, array('class' => 'col-md-4 form-control')); ?>
					</span>
				</div>
				<div class="col-md-8">
					<span class="input-group search-condition-input search-condition-input-end">
						<span class="input-group-addon">ロール</span>
						<?php echo Form::select('role_id', isset($view_search['role_id']) ? $view_search['role_id'] : "", $role_list, array('class' => 'col-md-4 form-control')); ?>
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
					<th class="nowrap">グループ&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">ロール&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="nowrap">
							<?php
							echo Html::anchor(MODULE.'/admin/group/view/'.$item->group_id,
								'<i class="icon-eye-open"></i> '.$item->group->name.'&nbsp;<span class="badge">'.$item->group_id.'</span>',
								array('class' => $view_permissions['group'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled'));
							?>
						</td>
						<td class="nowrap">
							<?php
							echo Html::anchor(MODULE.'/admin/role/view/'.$item->role_id,
								'<i class="icon-eye-open"></i> '.$item->role->name.'&nbsp;<span class="badge">'.$item->role_id.'</span>',
								array('class' => $view_permissions['role'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled'));
							?>
						</td>
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
		"aoColumnDefs": [{"bSortable": false, "aTargets": [2]}] // ソート除外
	});
</script>
