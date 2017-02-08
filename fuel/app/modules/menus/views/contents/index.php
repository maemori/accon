<div class="container">
	<?php echo render(FOUNDATION_MENU, array('active' => ACTION_INDEX, 'active_name' => ACTION_INDEX_NAME)); ?>
	<div class="row">
		<div class="col-md-3">
			<?php echo render('contents/_tree'); ?>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php
					echo \Html::anchor('/menus/contents/view/'.$entry->id,
						'<div class="text-left"><h1><span class="glyphicon glyphicon-eye-open"></span>&nbsp;'.
						mb_strimwidth(isset($entry) ? $entry->title : '', 0, 48, "...", "UTF-8").'</h1></div>',
						array('class' => 'btn btn-info btn-lg btn-block'));
					?>
				</div>
				<div class="panel-body">
					<?php echo \Markdown::parse(isset($entry) ? $entry->description : ''); ?>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12">
							<?php echo Form::open(array("id" => "search-condition-form", "class" => "form-inline")); ?>
							<?php echo Form::csrf(); // CSRF 保護 ?>
								<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
									<div class="btn-group btn-group-lg search-condition-btn">
										<button type="submit" name="processing" value="<?php echo SUBMIT_ADD ?>" class="<?php echo $authority[ACTION_CREATE] ? 'btn btn-warning' : 'btn btn-warning disabled'; ?>">
											<span title="<?php echo ACTION_CREATE_NAME; ?>" class="glyphicon glyphicon-plus"></span>
										</button>
									</div>
								</div>
							</div>
							<?php echo Form::close(); ?>
						</div>
					</div>
					<?php echo render('contents/_list'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
