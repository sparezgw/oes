<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('tag/add_tag'); ?>

<h5>用户ID</h5>
<input type="text" name="tUserID" value="<?php echo set_value('tUserID'); ?>" size="50" />


<h5>标签名称</h5>
<input type="text" name="tName" value="<?php echo set_value('tName'); ?>" size="50" />
<div><input type="submit" value="添加" /></div>

<?php echo form_close()?>
