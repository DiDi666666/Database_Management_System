<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>连接数据库</title>
</head>

<body>
<?php 
$hostname = "localhost"; //主机名,可以用IP代替129.204.188.232
$database = "rbms"; //数据库名
$username = "root"; //数据库用户名
$password = ""; //数据库密码123456
$conn = mysqli_connect($hostname, $username, $password,$database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


</body>
</html>