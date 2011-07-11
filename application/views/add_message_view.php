<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('message/add_message'); ?>
<h5>发件人</h5>
<input type="text" name="mFrom" value="<?php echo set_value('mFrom'); ?>" size="50" />

<h5>收件人</h5>
<input type="text" name="mTo" value="<?php echo set_value('mTo');?>" size="50" />

<h5>主题</h5>
<input type="text" name="mTitle" value="<?php echo set_value('mTitle'); ?>" size="50" />


<h5>内容</h5>
<input type="text" name="mBody" value="<?php echo set_value('mBody'); ?>" size="50" />

<h5>类型</h5>
<input type="text" name="mType" value="<?php echo set_value('mType'); ?>" size="50" />

<div><input type="submit" value="提交" /></div>



<?php echo form_close();?>
