<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
if(!isset($_SESSION['user'])&&!isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></p></div>";
require("footer.php");
exit();
}
?>
<div style="width:1300;height:568">
<?php
require("header.php");
?>
<br><br><br><br><br><br>
<center><h1><font color="#6633CC">欢迎使用酒店管理系统</font></h1></center>
</div>
<?php
require("footer.php");
?>
