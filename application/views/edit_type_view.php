<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo validation_errors(); ?>


<?php foreach($query->result() as $row):?>
	<?php $tID=$row->tID;?>
	<?php echo form_open('type/edit_type/'.$tID); ?>
	<h5>题型名称</h5>
	<input type="text" name="tTitle" value="<?php echo $row->tTitle;?>" size="50" />
	
	<h5>题型规则</h5>
	<input type="text" name="tRule" value="<?php echo $row->tRule;?>" size="50" />
	
	
	<div><input type="submit" value="修改" /></div>
	<?php echo form_close();?>
<?php endforeach;?>

