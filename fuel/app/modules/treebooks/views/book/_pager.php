<nav>
	<ul class="pager">
		<?php
			if ($previous_id !== false) {
				echo '<li class="previous">';
				$previous_url = $base_url.'?id='.$previous_id;
			} else {
				echo '<li class="previous disabled">';
				$previous_url = '#';
			}
			echo \Html::anchor($previous_url,
				'<span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>&nbsp;前のページ');
			echo '</li>';
		?>
		<?php
			if ($following_id !== false) {
				echo '<li class="next">';
				$following_url = $base_url.'?id='.$following_id;
			} else {
				echo '<li class="next disabled">';
				$following_url = '#';
			}
			echo \Html::anchor($following_url,
				'次のページ&nbsp;<span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>');
			echo '</li>';
		?>
	</ul>
</nav>
