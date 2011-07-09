<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo anchor('school/add_school','增加')?>
<table>

<tr>
	<th>学校ID</th>
	<th>学校名称</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->sID;?></td>
	<td><?php echo $row->sName;?></td>
	<td>
		<?php 
			echo anchor('school/edit_school/'.$row->sID,'修改');
			echo anchor('school/del_school/'.$row->sID,'删除');
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>


