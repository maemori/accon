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
 * 名称入力共通部品
 */
?>
<div class="form-group <?php echo !$val->error('name') ?: 'has-error' ?>">
	<?php echo Form::label('名称', 'name', array('class' => 'control-label')); ?>
	<?php echo Form::input('name', Input::post('name', isset($model) ? $model->name : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Name', $this->data[ACTION_EDIT] ? '' : 'disabled')); ?>
	<?php if ($val->error('name')): ?>
		<span class="control-label"><?php echo $val->error('name')->get_message(); ?></span>
	<?php endif; ?>
</div>