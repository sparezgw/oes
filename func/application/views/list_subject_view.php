<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo anchor('subject/add_subject','增加')?>
<table>

<tr>
	<th>科目ID</th>
	<th>科目名称</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->sID;?></td>
	<td><?php echo $row->sTitle;?></td>
	<td>
		<?php 
			echo anchor('subject/edit_subject/'.$row->sID,'修改');
			echo anchor('subject/del_subject/'.$row->sID,'删除');
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>


