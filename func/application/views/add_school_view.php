<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('school/add_school'); ?>

<h5>学校名称</h5>
<input type="text" name="sName" value="<?php echo set_value('sName'); ?>" size="50" />
<div><input type="submit" value="添加" /></div>

<?php echo form_close()?>
