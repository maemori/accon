		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<span title="Book" class="glyphicon glyphicon-list-alt"></span>&nbsp;メニュー構成
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="tree-panel-collapse panel-collapse collapse in panel-tree">
					<div class="tree-panel-body panel-body">
						<?php Menus\Library_Utility::tree_output($parent_id, $tree); ?>
					</div>
				</div>
			</div>
		</div>
