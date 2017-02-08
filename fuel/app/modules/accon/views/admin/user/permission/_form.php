<fieldset>
	<?php echo render('admin/user/_get_user', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/permission/_get_permission', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/permission/_get_actions', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
