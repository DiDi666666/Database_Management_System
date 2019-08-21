<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加数据</title>
</head>

<body>
<?php include "conn.php";
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?> 
<?php
  $tb_name=$_POST['tb_name'];     //先接收传过来的数据表名以判断更新哪个表的数据
  $sql1 = "describe $tb_name";    //获取数据表结构
  $res1 = mysqli_query($conn,$sql1);  
  $row1 = mysqli_num_rows($res1);  
  $alter = Array();                  //用于存放添加的各字段值
  if($tb_name=='purchases')
      $row1 = 5;
  for($i=0;$i<$row1;$i++){              
      $dbrow1=mysqli_fetch_array($res1);
	  $alter[$i] = $_POST[$dbrow1[0]];       //获取数据表各字段值
	  if($i===0)
	    $judgerow = $dbrow1[0];
  }
  if($tb_name=='customers')  //判断数据表，以便插入新数据
  {
	  $query = "INSERT INTO $tb_name(cid,cname,city,visits_made,last_visit_time) VALUES ('$alter[0]','$alter[1]','$alter[2]',$alter[3],'$alter[4]')";  
      $res = mysqli_query($conn,$query);
  }
  else if($tb_name=='employees')
  {
      $query = "INSERT INTO $tb_name(eid,ename,city) VALUES ('$alter[0]','$alter[1]','$alter[2]')";  
      $res = mysqli_query($conn,$query);
  }
  else if($tb_name=='suppliers')
  {
      $query = "INSERT INTO $tb_name(sid,sname,city,telephone_no) VALUES ('$alter[0]','$alter[1]','$alter[2]','$alter[3]')";  
      $res = mysqli_query($conn,$query);
  }
  else if($tb_name=='products')
  {
      $query = "call add_products('$alter[0]','$alter[1]',$alter[2],$alter[3],$alter[4],$alter[5],'$alter[6]')";  
      $res = mysqli_query($conn,$query);
  }
  else if($tb_name=='purchases')
  {
     $query = "call add_purchases('$alter[0]','$alter[1]','$alter[2]','$alter[3]',$alter[4],@error)";  
     $res = mysqli_query($conn,$query); 
	 $error = mysqli_query($conn,"select @error"); //收集错误标志位
	 $dbrow = mysqli_fetch_array($error);
	 
	 $messages = mysqli_query($conn,"select * from messages");//查看messages表，是否有数据，若有则需打印提示信息。
	 $row = mysqli_num_rows($messages); 
	 if($row)
        for($i=0;$i<$row;$i++)   
	        $dbrow1=mysqli_fetch_array($messages);
  }
  if($tb_name=='purchases')
  {
	  if($res)
	  {
		  if($dbrow['@error'])
		  {
	           echo "<script>alert('添加失败，库存数量不足！')</script>";
	           mysqli_query($conn,'set @error = 0'); 
		  }
		  else
		  {
			  echo "<script></script>";
			  echo "<script>alert('添加成功！');</script>";
			  if($row)  //若messages表中有数据，则弹出提示框
    	      {
	    	      echo "<script>alert('购买后库存数量为:$dbrow1[0],小于下限。自动进货，进货量为：$dbrow1[1]');</script>";
	    	      mysqli_query($conn,'delete from messages');
	          }
		  }
	  }
	  else
	      echo "<script>alert('添加失败！');</script>";
	      
  }
  else
  {
	  if($res)
	      echo "<script>alert('添加成功！')</script>";
      else
	      echo "<script>alert('添加失败!')</script>";
  }
  echo "<script>history.go(-3);</script>";
?>
</body>
</html>