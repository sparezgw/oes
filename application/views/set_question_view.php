<html>
<head></head>
<body>



<?php echo form_open('question/set_question'); ?>

<label>*题目</label><?php echo form_error('title'); ?><br />
<input type="text" name="title" value="<?php echo set_value('title'); ?>" size="50" /><br /><br />

<label>*选项A</label><?php echo form_error('op1'); ?><br />
<input type="text" name="op1" value="<?php echo set_value('op1'); ?>" size="50" /><br /><br />

<label>*选项B</label><?php echo form_error('op2'); ?><br />
<input type="text" name="op2" value="<?php echo set_value('op2'); ?>" size="50" /><br /><br />

<label>*选项C</label><?php echo form_error('op3'); ?><br />
<input type="text" name="op3" value="<?php echo set_value('op3'); ?>" size="50" /><br /><br />

<label>*选项D</label><?php echo form_error('op4'); ?><br />
<input type="text" name="op4" value="<?php echo set_value('op4'); ?>" size="50" /><br /><br />

<label>*答案</label><?php echo form_error('key'); ?><br />
<?php 
	echo form_radio('key', 'a')."选项A";
	echo form_radio('key', 'b')."选项B";
	echo form_radio('key', 'c')."选线C";
	echo form_radio('key', 'd')."选项D";
	echo "<br />";
	echo form_submit('submit','提交');
	//echo $error;
	echo form_close();
?>



</body>
</html>