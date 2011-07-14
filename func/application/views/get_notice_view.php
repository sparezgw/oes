<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table>

<tr>
	<th>公告ID</th>
	<th>所属学校</th>
	<th>公告标题</th>
	<th>公告内容</th>
	<th>发布时间</th>
	
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->nID;?></td>
	<td><?php echo $row->nSchoolID;?></td>
	<td><?php echo $row->nTitle;?></td>
	<td><?php echo $row->nBody;?></td>
	<td><?php echo $row->nTime;?></td>
</tr>
	
	
<?php endforeach;?>
</table>
<?php echo anchor('notice/list_notice','返回列表');?>