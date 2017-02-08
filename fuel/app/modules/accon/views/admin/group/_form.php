<fieldset>
	<?php echo render('foundation/_get_name', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/user/_get_username', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
