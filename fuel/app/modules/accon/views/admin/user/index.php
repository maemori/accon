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
						<?php echo Form::input('username', isset($view_search['username']) ? $view_search['username'] : '', array('class' => 'form-control')); ?>
					</span>
				</div>
				<div class="col-md-4">
					<span class="input-group search-condition-input">
						<span class="input-group-addon">グループ</span>
						<?php echo Form::select('group_id', isset($view_search['group_id']) ? $view_search['group_id'] : '', $group_list, array('class' => 'col-md-4 form-control')); ?>
					</span>
				</div>
				<div class="col-md-4">
					<span class="input-group search-condition-input-end">
						<span class="input-group-addon">メール</span>
						<?php echo Form::input('email', isset($view_search['email']) ? $view_search['email'] : '', array('class' => 'form-control')); ?>
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
					<th>パスワード</th>
					<th class="nowrap">グループ&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">メール</th>
					<th>最終ログイン</th>
					<th>前回ログイン</th>
					<th class="nowrap">更新者&nbsp;<span class="badge">ID</span></th>
					<th class="nowrap">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($model as $item): ?>
					<tr id="search-result">
						<td class="nowrap"><?php echo $item->username.'&nbsp;<span class="badge">'.$item->id.'</span>'; ?></td>
						<td class="nowrap">
							<?php
							echo Html::anchor(MODULE.'/admin/user/password/'.$item->id,
								'<span title="変更" class="glyphicon glyphicon-text-color"></span>',
								array('class' => $view_permissions['password'] ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-warning disabled'));
							?>
						</td>
						<td>
							<?php
							echo Html::anchor(MODULE.'/admin/group/view/'.$item->group_id,
								'<i class="icon-eye-open"></i> '.(isset($item->group->name) ? $item->group->name : '').'&nbsp;<span class="badge">'.$item->group_id.'</span>',
								array('class' => $view_permissions['group'] ? 'btn btn-sm btn-info' : 'btn btn-sm btn-info disabled'));
							?>
						</td>
						<td class="break-word"><?php echo $item->email; ?></td>
						<td class="break-word"><?php echo !empty($item->last_login) ? Date::time_ago($item->last_login) : ''; ?></td>
						<td class="break-word"><?php echo !empty($item->previous_login) ? Date::time_ago($item->previous_login) : ''; ?></td>
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
		"aoColumnDefs": [{"bSortable": false, "aTargets": [1, 7]}] // ソート除外
	});
</script>