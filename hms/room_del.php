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
$roomid=$_GET['roomid'];
$sql="delete from room where roomid='$roomid';";
mysql_query($sql,$conn) or die("删除失败：".mysql_error());
mysql_close();
?>
<div style="width:1300;height:568; text-align:center">
<img src="header1.jpg" ><br><br>
<font size="+3" color="#FF0000">删除成功!</font><br>
<a href="#" onClick="window.history.go(-1)">返回</a>
</div>
<?php
require("footer.php");
?>