<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询客户<?php echo $_GET['cus_id'];?>的购买情况</title>
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
	padding-bottom:25px;
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
p{
	margin-left:60px;
	font-size:20px;
	color: #000;
}
</style>
</head>

<body>
<?php include "conn.php";
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?> 
<p class="title">数据库管理系统</p>
<div class="main">
<div class="top">客户<?php echo $_GET['cus_id'];?>的购买情况如下:</div>
<?php
  $cid= $_GET['cus_id'];     //先接收传过来的客户id
  $sql = "call before_find_cid($cid,@error)";    //调用创建好的存储过程before_find_cid
  $res = mysqli_query($conn,$sql);  
  $error = mysqli_query($conn,"select @error"); //收集错误标志位
  if($error)
      $dbrow1 = mysqli_fetch_array($error);
  else
  {
	 $row = mysqli_num_rows($res); 
     if($row)
	 {   //显示客户购买情况
        echo "<table border='1px' width='1150px'>
	          <tr><td>pur</td><td>cid</td><td>eid</td><td>pid</td>
	      	  <td>qty</td><td>ptime</td><td>total_price</td></tr>";
	    for($j=0;$j<$row;$j++)
		{    
            $dbrow=mysqli_fetch_row($res); 
	    	echo "<tr>";
	    	for($k=0;$k<count($dbrow);$k++)
        	    echo "<td>",$dbrow[$k],"</td>";
	    	echo "</tr>";
	    }
      }
	  else
	      echo "<p>该顾客暂未购买产品!</p>";
  }
  echo "</table>";
?>
<script>
if(<?php echo $dbrow1['@error']?>)
{
      window.alert("该客户cid不存在，请重新输入！");
	  <?php mysqli_query($conn,'set @error = 0'); ?>
	  history.go(-1);
}
</script>
</div>
</body>
</html>