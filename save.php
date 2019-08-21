<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更新数据</title>
</head>

<body>
<?php include "conn.php";      // Task3_conn.php用于连接数据库
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?> 
<?php
  $tb_name=$_POST['tb_name'];     //先接收传过来的数据表名以判断更新哪个表的数据
  $sql1 = "describe $tb_name";    //获取数据表结构
  $res1 = mysqli_query($conn,$sql1);  
  $row1 = mysqli_num_rows($res1);  
  $alter = Array();                  //用于存放修改后的各字段值
  for($i=0;$i<$row1;$i++)
  {              
      $dbrow1=mysqli_fetch_array($res1);
	  $alter[$i] = $_POST[$dbrow1[0]];       //获取数据表各字段值
	  if($i==0)
	     $alterrow = $dbrow1[0];
	  $query = "Update $tb_name set $dbrow1[0]='$alter[$i]' where $alterrow=$alter[0]";  //只更新需更新的那一行
      $res = mysqli_query($conn,$query) ;  //更新
  }
  if($res)
	  echo "<script>alert('修改成功！')</script>";
  else
      echo "<script>alert('修改失败,$judgerow不能重复！')</script>";
  echo "<script>history.go(-3)</script>; ";
?>
</body>
</html>