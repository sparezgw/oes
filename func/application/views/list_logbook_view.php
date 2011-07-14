<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table>

<tr>
	<th>日志ID</th>
	<th>时间</th>
	<th>用户ID</th>
	<th>操作名称</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->lID;?></td>
	<td><?php echo $row->lTime;?></td>
	<td><?php echo $row->lUserID;?></td>
	<td><?php echo $row->lAction;?></td>
	<td>
		<?php 
			echo anchor('logbook/del_logbook/'.$row->lID,'删除');
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>

