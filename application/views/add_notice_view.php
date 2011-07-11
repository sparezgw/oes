<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>

<?php echo form_open('notice/add_notice'); ?>
<h5>所属学校</h5>
<input type="text" name="nSchoolID" value="<?php echo set_value('nSchoolID'); ?>" size="50" />


<h5>公告标题</h5>
<input type="text" name="nTitle" value="<?php echo set_value('nTitle');?>" size="50" />

<h5>公告标题</h5>
<input type="text" name="nTitle" value="<?php echo set_value('nTitle'); ?>" size="50" />


<h5>公告内容</h5>
<input type="text" name="nBody" value="<?php echo set_value('nBody'); ?>" size="50" />

<div><input type="submit" value="提交" /></div>



<?php echo form_close();?>