<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table>
<tr>
	<th>消息ID</th>
	<th>发件人</th>
	<th>收件人</th>
	<th>主题</th>
	<th>内容</th>
	<th>PID</th>
	<th>发布时间</th>
	<th>类型</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->mID;?></td>
	<td><?php echo $row->mFrom;?></td>
	<td><?php echo $row->mTo;?></td>
	<td><?php echo $row->mTitle;?></td>
	<td><?php echo $row->mBody;?></td>
	<td><?php echo $row->mPID;?></td>
	<td><?php echo $row->mTime;?></td>
	<td><?php echo $row->mType;?></td>
	<td>
		<?php 
			echo anchor('message/del_message/'.$row->mID,'删除');
			echo anchor('message/reply_message/'.$row->mID.'/'.$row->mPID,'回复')
		?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>