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
 * 表示件数制御標準部品
 */
?>
<span class="input-group search-condition-input">
	<span class="input-group-addon">表示件数</span>
	<?php echo Form::select('rows', $view_control['row'], $view_control['rows'], array('class' => 'form-control text-right')); ?>
</span>
