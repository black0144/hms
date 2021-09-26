<?php
session_start();
require("dbconnect.php");
//已登录管理员账号，跳转到admin_index.php
if(isset($_SESSION['admin'])){
header("location:admin_index.php");
exit;
}
//已登录用户账号，跳转到user_index.php
if(isset($_SESSION['user'])){
header("location:user_index.php");
exit;
}
$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from user where username='$username';";
$result=mysql_query($sql,$conn);
$result1=mysql_fetch_array($result);
$dbpassword=$result1['password'];
//密码验证通过
if($password==$dbpassword){
//用户名为admin跳转到admin_index.php
if($username=='admin'){
session_register("admin");
$admin=$username;
header("location:admin_index.php");
}
else{
//用户名不为admin跳转到user_index.php
session_register("user");
$user=$username;
header("location:user_index.php");
}
}
else{
//密码没有验证通过
echo "<div style=\"width:1300;height:568;text-align:center\">";
echo"<p align='center'><img src='header1.jpg'></p>";
echo "<center>账号或密码错误 <br>";
echo"<a href='index.php'>请重试</a></center></div>";
require("footer.php");
}
?>
