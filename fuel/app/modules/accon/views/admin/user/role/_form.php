<fieldset>
	<?php echo render('admin/user/_get_user', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/role/_get_role', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
