<div class="row">
	<div class="col-md-12">
		<ul class="list-group">
			<?php
				if ($model) {
					foreach ($model as $item) {
						echo '<li class="list-group-item">';
						echo Html::anchor($base_url.'/?id='.$item->id,
							'<div class="text-left">'.
							'<span title="子へ" class="glyphicon glyphicon-triangle-right">&nbsp;'.
							$item->title.
							'</div>',
							array());
						echo '</li>';
					}
				}
			?>
		</ul>
	</div>
</div>
