<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>


<?php foreach($query->result() as $row):?>
	<?php $sID=$row->sID;?>
	<?php echo form_open('school/edit_school/'.$sID); ?>
	<h5>学校名称</h5>
	<input type="text" name="sName" value="<?php echo $row->sName;?>" size="50" />
	<div><input type="submit" value="修改" /></div>
	<?php echo form_close();?>
<?php endforeach;?>
