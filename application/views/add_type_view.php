<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('type/add_type'); ?>

<h5>题型名称</h5>
<input type="text" name="tTitle" value="<?php echo set_value('tTitle'); ?>" size="50" />

<h5>题型规则</h5>
<input type="text" name="tRule" value="<?php echo set_value('tRule'); ?>" size="50" />
<div><input type="submit" value="添加" /></div>

<?php echo form_close()?>
