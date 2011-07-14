<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo anchor('tag/add_tag','增加')?>
<table>

<tr>
	<th>标签ID</th>
	<th>用户ID</th>
	<th>标签名称</th>
	<th>标签数量</th>
	
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->tID;?></td>
	<td><?php echo $row->tUserID;?></td>
	<td><?php echo $row->tName;?></td>
	<td><?php echo $row->tCount;?></td>
</tr>
	
	
<?php endforeach;?>
</table>


