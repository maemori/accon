<div class="container">
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_INDEX, 'active_name' => ACTION_INDEX_NAME)); ?>
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
							<span class="input-group-addon">タイトル</span>
							<?php echo Form::input('title', $view_search['title'], array('class' => 'form-control')); ?>
						</span>
					</div>
					<div class="col-md-3">
						<span class="input-group search-condition-input">
							<span class="input-group-addon">ステータス</span>
							<?php echo Form::select('status', $view_search['status'], $status, array('class' => 'col-md-4 form-control')); ?>
						</span>
					</div>
					<div class="col-md-5">
						<span class="input-group search-condition-input search-condition-input-end">
							<span class="input-group-addon">パーミッション</span>
							<?php echo Form::select('perms_id', $view_search['perms_id'], $permission_list, array('class' => 'col-md-4 form-control')); ?>
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
			<?php echo render('maker/_list'); ?>
		</div>
	</div>
</div>
