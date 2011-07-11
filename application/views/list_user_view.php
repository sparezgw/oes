<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table>

<tr>
	<th>用户ID</th>
	<th>用户名</th>
	<th>密码</th>
	<th>真实姓名</th>
	<th>性别</th>
	<th>生日</th>
	<th>个人信息</th>
	<th>权限</th>
	<th>操作</th>
</tr>
<?php foreach($query->result() as $row):?>
<tr>
	<td><?php echo $row->uID;?></td>
	<td><?php echo $row->uName;?></td>
	<td><?php echo $row->uPassword;?></td>
	<td><?php echo $row->uTruename;?></td>
	<td><?php echo $row->uGender;?></td>
	<td><?php echo $row->uBday;?></td>
	<td><?php echo $row->uInfo;?></td>
	<td><?php echo $row->uIdentify;?></td>
	<td>
		<?php echo anchor('message/list_to_message/'.$row->uID,'查看所有收到邮件');?>
		<?php echo anchor('message/list_from_message/'.$row->uID,'查看所有发出邮件');?>
	</td>
</tr>
	
	
<?php endforeach;?>
</table>
