<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除数据</title>
</head>

<body>
<?php include "conn.php";      // Task3_conn.php用于连接数据库
  mysqli_set_charset($conn,'utf8');  //数据库传输过程使用utf8字符集
 ?>
<?php
 $tb_name = $_GET['tb_name']; //获取需要操作的数据所属的数据表名
 $delerow = $_GET['delerow']; //获取需要做操作的数据的第一个字段值，用来确认删除哪一行
 $sql1 = "describe $tb_name"; //查询数据表结构
 $res1 = mysqli_query($conn,$sql1);
 $dbrow = mysqli_fetch_array($res1);  //查询数据表的第一个字段名
 $sql2 = "delete from $tb_name where $dbrow[0]='$delerow'"; //删除对应数据
 $res2= mysqli_query($conn,$sql2);  //删除
?>
<script>
var res = <?php echo $res2 ?>;
if(res){
   alert('删除成功！');
   history.go(-2);
}else{
   alert('删除失败！');
   history.go(-2);
}
</script>
</body>
</html>