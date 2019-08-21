<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理<?php echo $_GET['tb_name'];?>数据表</title>
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
	padding-bottom:30px;
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
button{
	display:block;
	font-size:20px;
	width:150px;
	height:50px;
	margin-left:60px;
	margin-bottom:40px;
}
button a{
	text-decoration:none;
	color:#000;
}
p{
	margin-left:60px;
	font-size:20px;
	color:#F00;
}
span{
	margin-left:60px;
	margin-top:60px;
	font-size:23px;
	color: #000;
}
.pid{
	width:100px;
	height:30px;
	font-size:20px;
}
.search_pid{
	font-size:20px;
	border:none;
	background:none;
	text-decoration:underline;
	color:#00F;
	cursor:pointer;
}
form{
    display:inline;	
}
</style>
</head>

<body>
<?php 
  include 'conn.php';  // conn.php用于连接数据库
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
?>
<p class="title">数据库管理系统</p>
<div class="main">
  <div class="top">数据表<?php echo $_GET['tb_name'];?>中的所有记录如下</div>
  <?php
  echo "<table border='1px' width='1150px'>";  //为输出表格设置边框
  $tb_name = $_GET['tb_name'];  //获取上个页面传来的数据表名
  $sql1 = "describe $tb_name";  //查询数据表结构
  $sql2 = "select * from $tb_name";  //查询数据表中的所有记录
  $res1 = mysqli_query($conn,$sql1);
  $res2 = mysqli_query($conn,$sql2);
  $row1 = mysqli_num_rows($res1); 
  $row2 = mysqli_num_rows($res2); 
  if($row1){   //显示数据表头
	  echo "<tr>";
      for($i=0;$i<$row1;$i++){    
         $dbrow1=mysqli_fetch_array($res1);//逐行获取数据
         echo "<td>",$dbrow1[0],"</td>";
	  }
	  echo "<td colspan='2'>操作</td>"; //跨两列
	  echo "</tr>";
	  }else{
         echo "该数据表中还没有字段，请创建";
  }
  if($row2){   //显示数据记录
	 for($j=0;$j<$row2;$j++){    
        $dbrow2=mysqli_fetch_row($res2); 
		echo "<tr>";
		for($k=0;$k<count($dbrow2);$k++){
    	    echo "<td>",$dbrow2[$k],"</td>";
		}
		echo "<td><a href='alter.php?tb_name=$tb_name&alterrow=$dbrow2[0]'>修改</a></td>";
		//将要修改的数据所在的数据表名和第一个字段值以GET方式发送到alter.php
		echo "<td><a href='dele.php?tb_name=$tb_name&delerow=$dbrow2[0]'>删除</a></td>";
		//将要删除的数据所在的数据表名和第一个字段值以GET方式发送到dele.php
		echo "</tr>";
	 }
  }else{
	  echo "<p>该数据表中还没有数据，请创建</p>";
  }
  echo "</table>";
  ?>
  <?php 
   if($tb_name!='logs')  //logs表为日志表，不能手动添加数据
       echo "<button><a href='add.php?tb_name=$tb_name'>添加新数据</a></button>"
   //将要添加数据的数据表名以GET方式发送到add.php
  ?>
  
  <?php
    if($tb_name=="products")  //对products表提供查询月销情况的功能
	{   //将要查询的产品id以get方式传输到search_products.php
        echo "<span>查询产品月销情况，请输入产品pid:</span>
		      <form action='search_products.php' method='get'>  
			    <input type='text' name='prod_id' class='pid'/>
				<input type='submit' value='查看' class='search_pid'/>
		      </form>";
	}
	if($tb_name=="customers")  //对purchases表提供查询月销情况的功能
	{   //将要查询的客户id以get方式传输到search_purchases.php
        echo "<span>查询客户购买情况，请输入客户cid:</span>
		      <form action='search_purchases.php' method='get'>  
			    <input type='text' name='cus_id' class='pid'/>
				<input type='submit' value='查看' class='search_pid'/>
		      </form>";
	}
  ?>
</div>
</body>
</html>