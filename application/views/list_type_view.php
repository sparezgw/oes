<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo anchor('type/add_type','增加')?>
<table>

<tr>
	<th>题型ID</th>
	<th>题型名称</th>
	<th>题型规则</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->tID;?></td>
	<td><?php echo $row->tTitle;?></td>
	<td><?php echo $row->tRule;?></td>
	<td>
		<?php 
			echo anchor('type/edit_type/'.$row->tID,'修改');
			echo anchor('type/del_type/'.$row->tID,'删除');
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>
