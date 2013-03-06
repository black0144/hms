<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
require("dbconnect.php");
if(!isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></p></div>";
require("footer.php");
exit();
}
?>
<?php
$username=$_POST['username'];
$password=$_POST['password'];
$sql="insert into user(username,password) values('$username','$password');";
mysql_query($sql,$conn) or die("插入数据失败：".mysql_error());
echo "<div style=\"width:1300;height:568; text-align:center\">";
require("header1.php");
echo "<br><br><br><center><font color='red' size='+5'>提交成功</font><br><a href='#' onClick='window.history.go(-2)'>返回</a></center></div>";
require("footer.php");
?>