<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改数据</title>
<style>
body{
  background-color: #09C;
}
.title{
	font-size:30px;
	color:#FFF;
	font-weight:600px;
	width:225px;
	margin:0 auto;
	margin-top:30px;
	text-align:center;
}
.main{
	width:80%;
	min-height:600px;
	background-color:#FFF;
	margin:0 auto;
	margin-top:20px;
	border:none;
	/*box-shadow:0px 0px 10px 10px darkgray;*/
}

.top{
	font-size:25px;
	width:500px;
	height:50px;
	padding-top:40px;
	margin-left:60px;
}
table{
	font-size:20px;
	width:90%;
	margin-left:60px;
	margin-bottom:20px;
}
input{
	font-size:20px;
	width:100%;
	height:20px;
}
.s{
	display:block;
	width:100px;
	height:50px;
	margin-left:60px;
}
</style>
</head>

<body>
<?php include "conn.php";      // conn.php用于连接数据库
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?>
<p class="title">数据库管理系统</p>
<div class="main">
  <div class="top">修改数据</div>
  <?php
  echo '<form action="save.php" method="post">';//将修改数据以post传输到save.php
  echo "<table border='1px'>";    //设置表格边框
  $tb_name = $_GET['tb_name'];    //获取需要操作的数据所属的数据表名
  $alterrow = $_GET['alterrow'];   //获取需要做操作的数据的第一个字段名，用来确认修改哪一行
  $sql1 = "describe $tb_name";    //获取数据表的结构
  $res1 = mysqli_query($conn,$sql1);  
  $row1 = mysqli_num_rows($res1); //数据表列数
  echo "<input type='hidden' name='tb_name' value='$tb_name'/>";  //将数据表名传输，以便判断更新哪个表
  echo "<tr><td>字段</td><td>类型</td><td>值</td></tr>";   
  for($i=0;$i<$row1;$i++){ 
	  echo "<tr>";
      $dbrow1=mysqli_fetch_array($res1);
      echo "<td>$dbrow1[0]</td>";  //显示字段名
	  echo "<td>$dbrow1[1]</td>";  //显示数据类型
	  if($i==0){
		  $sql2 = "select * from $tb_name where $dbrow1[0]='$alterrow'"; //查询要修改的那一行的数据
          $res2= mysqli_query($conn,$sql2);  //查询
	      $dbrow2 = mysqli_fetch_array($res2);
	  }
	  echo "<td><input type='text' value='$dbrow2[$i]' name='$dbrow1[0]'/></td>";  //显示数据原来的值
	  echo "</tr>";
  }
  echo '</table>';
  echo '<input type="submit" value="确认修改" class="s"/>';
  echo '</form>';
  ?>
</div>
</body>
</html>