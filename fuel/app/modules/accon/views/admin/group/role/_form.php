<fieldset>
	<?php echo render('admin/group/_get_group', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/role/_get_role', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
