<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('home/register'); ?>

<h5>用户名</h5>
<input type="text" name="uName" value="<?php echo set_value('uName'); ?>" size="50" />


<h5>密码</h5>
<input type="text" name="uPassword" value="<?php echo set_value('uPassword');?>" size="50" />

<h5>真实姓名</h5>
<input type="text" name="uTruename" value="<?php echo set_value('uTruename'); ?>" size="50" />

<h5>性别</h5>
<input type="text" name="uGender" value="<?php echo set_value('uGender'); ?>" size="50" />

<h5>生日</h5>
<input type="text" name="uBday" value="<?php echo set_value('uBday'); ?>" size="50" />

<!--  
<h5>个人信息</h5>
<input type="text" name="uInfo" value="<?php echo set_value('uInfo'); ?>" size="50" />
-->


<div><input type="submit" value="提交" /></div>



<?php echo form_close();?>