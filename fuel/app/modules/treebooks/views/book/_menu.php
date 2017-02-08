<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="/"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php echo MENU_HOME; ?></a></li>
			<?php
				$top_flg = true;
				foreach ($ancestors_list as $ancestors) {
					if ($top_flg) {
						$icon_style = 'glyphicon-book';
						$top_flg = false;
					} else {
						$icon_style = 'glyphicon-list-alt';
					}
					echo '<li>';
					echo \Html::anchor($base_url.'/?id='.$ancestors['id'],
						'<span class="glyphicon '.$icon_style.'"></span>&nbsp;'.
						mb_strimwidth($ancestors['title'], 0, 16, '...', 'UTF-8' ));
					echo '</li>';
				}
				echo '<li class="active">';
				echo '<span class="glyphicon glyphicon-eye-open"></span>&nbsp;'.
					mb_strimwidth($entry['title'], 0, 16, '...', 'UTF-8');
				echo '</li>';
			?>
		</ul>
	</div>
</div>