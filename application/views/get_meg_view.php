<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="refresh" content="2; URL=<?php echo $url;?>" />
<title>管理区域</title>
</head>
<body>
<div id="man_zone">
  <table width="30%" border="1" align="center"  cellpadding="3" cellspacing="0" class="table" style="margin-top:100px;">
    <tr>
      <th align="center" style="background:#cef">信息提示</th>
    </tr>
    
    <tr>
      <td><p><?php echo $show;?><br />
      2秒后返回指定页面！<br />
      如果浏览器无法跳转，<a href="<?php echo $url;?>">请点击此处</a>。</p>
      </td>
    </tr>
  </table>
</div>
</body>
</html>