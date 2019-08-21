<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询产品<?php echo $_GET['prod_id'];?>的月销情况</title>
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
<div class="top">产品<?php echo $_GET['prod_id'];?>的月销情况如下:</div>
<?php
  $pid= $_GET['prod_id'];     //先接收传过来的产品id
  $sql = "call report_sale($pid)";    //调用创建好的存储过程report_sale(prod_id)
  $res = mysqli_query($conn,$sql);  
  $row = mysqli_num_rows($res);  
  if($row){   //显示产品月销情况
     echo "<table border='1px' width='1150px'>
	      <tr><td>pid</td><td>pname</td><td>month</td><td>year</td>
		  <td>total_quantity</td><td>total_price</td><td>average_price</td></tr>";
	 for($j=0;$j<$row;$j++){    
        $dbrow=mysqli_fetch_row($res); 
		echo "<tr>";
		for($k=0;$k<count($dbrow);$k++)
    	    echo "<td>",$dbrow[$k],"</td>";
		echo "</tr>";
	 }
  }else{
	  echo "<p>暂未有顾客购买该商品</p>";
  }
  echo "</table>";
?>

</div>
</body>
</html>