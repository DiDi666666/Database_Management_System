<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库管理系统</title>
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
.show{
	font-size:22px;
	width:500px;
	height:300px;
	margin-left:60px;
	margin-bottom:20px;
}
p{
	margin-left:60px;
	font-size:20px;
	color:#F00;
}
</style>
</head>

<body>
<?php 
  include "conn.php";
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集    
 ?>  <!--conn.php用于连接数据库-->
<p class="title">数据库管理系统</p>
<div class="main">
  <div class="top">数据库RBMS中的所有表如下</div>
  <div class="show">
  <?php 
    $sql = "SHOW TABLES";  //显示数据库的所有表名
	$res = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($res); 
	if($row)
    {
        for($i=0;$i<$row-2;$i++)  
        { 
           $dbrow=mysqli_fetch_array($res); 
		   if($dbrow[0]!='messages'&&$dbrow[0]!='error')
               echo $i+1,". ","<a href='query.php?tb_name=$dbrow[0]'>$dbrow[0]</a>","<br>";
		   else
		       $i=$i-1; 
	    }
    }else{
         echo "<p>该数据库中还没有表，请创建</p>";
    }
   ?>
   </div>
</div>
</body>
</html>