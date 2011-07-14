<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('subject/add_subject'); ?>

<h5>科目名称</h5>
<input type="text" name="sTitle" value="<?php echo set_value('sTitle'); ?>" size="50" />
<div><input type="submit" value="添加" /></div>

<?php echo form_close()?>

