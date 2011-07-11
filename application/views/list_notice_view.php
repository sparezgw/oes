<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php echo anchor('notice/add_notice','增加')?>
<table>

<tr>
	<th>公告ID</th>
	<th>所属学校</th>
	<th>公告标题</th>
	<th>发布时间</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->nID;?></td>
	<td><?php echo $row->nSchoolID;?></td>
	<td><?php echo anchor('notice/get_notice/'.$row->nID,$row->nTitle);?></td>
	<td><?php echo $row->nTime;?></td>
	<td>
		<?php 
			echo anchor('notice/del_notice/'.$row->nID,'删除');
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>
