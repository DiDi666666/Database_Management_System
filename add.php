<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新数据</title>
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
<?php include "conn.php";
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?>
<p class="title">数据库管理系统</p>
<div class="main">
  <div class="top">在数据表<?php echo $_GET['tb_name']?>中添加新数据</div>
  <?php
  echo '<form action="savenew.php" method="post">';//将修改数据以post传输到savenew.php
  echo "<table border='1px' width='1150px'>";    //设置表格边框
  $tb_name = $_GET['tb_name'];    //获取需要操作的数据所属的数据表名
  $sql1 = "describe $tb_name";    //获取数据表结构
  echo "<tr><td>字段</td><td>类型</td><td>值</td></tr>";
  echo "<input type='hidden' name='tb_name' value='$tb_name'/>";  //将数据表名传输，以便判断更新哪个表
  if($tb_name!='purchases')
  {
      $res1 = mysqli_query($conn,$sql1);  
      $row1 = mysqli_num_rows($res1); //数据表列数
      for($i=0;$i<$row1;$i++)
	  {    
		   $dbrow1=mysqli_fetch_array($res1);
		   echo "<tr>
           <td>$dbrow1[0]</td>  
	       <td>$dbrow1[1]</td>  
	       <td><input type='text' value='' name='$dbrow1[0]'/></td>
		   </tr>"; 
      }
  }
  else  //purchases表做特殊处理
  {
	  echo "<tr>
            <td>pur</td>  
	        <td>varchar(4)</td> 
	        <td><input type='text' value='' name='pur'/></td>
		    </tr>
		    <tr>
            <td>cid</td>  
	        <td>varchar(4)</td>  
	        <td><input type='text' value='' name='cid'/></td>
		    </tr>
			<tr>
            <td>eid</td> 
	        <td>varchar(3)</td>  
	        <td><input type='text' value='' name='eid'/></td>
			</tr>
			<tr>
            <td>pid</td>  
	        <td>varchar(4)</td>  
	        <td><input type='text' value='' name='pid'/></td>
			</tr>
			<tr>
            <td>qty</td>  
	        <td>int(5)</td>  
	        <td><input type='text' value='' name='qty'/></td>
			</tr>
		    ";  
  }
  echo '</table>';
  echo '<input type="submit" value="确认添加" class="s"/>';  
  echo '</form>';  
  ?>
</div>
</body>
</html>