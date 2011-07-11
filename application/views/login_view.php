<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('home/login'); ?>
<h5>用户名</h5>
<input type="text" name="uName" value="<?php echo set_value('uName'); ?>" size="50" />


<h5>密码</h5>
<input type="text" name="uPassword" value="<?php echo set_value('uPassword');?>" size="50" />

<div><input type="submit" value="提交" /></div>



<?php echo form_close();?>
