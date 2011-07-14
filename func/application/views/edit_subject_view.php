<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>


<?php foreach($query->result() as $row):?>
	<?php $sID=$row->sID;?>
	<?php echo form_open('subject/edit_subject/'.$sID); ?>
	<h5>科目名称</h5>
	<input type="text" name="sTitle" value="<?php echo $row->sTitle;?>" size="50" />
	<div><input type="submit" value="修改" /></div>
	<?php echo form_close();?>
<?php endforeach;?>
