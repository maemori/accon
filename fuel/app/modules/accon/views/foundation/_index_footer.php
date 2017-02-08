<?php
/**
 * Part of the kurobuta.jp.
 *
 * Copyright (c) 2015 Maemori Fumihiro
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 *
 * @version    1.0
 * @author     Maemori Fumihiro
 * @link       https://kurobuta.jp
 */

/**
 * 検索VIEWの標準フッター
 */
?>
	<?php if (!$model) echo '<div class="alert alert-warning" role="alert">'.ERROR_DATA_NOT_EXIST_MESSAGE.'</div>'; ?>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right"><?php echo Pagination::instance('pagination')->render(); ?></div>
		</div>
	</div>
</div>
