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
$level=$_POST['level'];
$percent=$_POST['percent'];
$sql="update discount set `percent`='$percent' where `level`='$level';";
mysql_query($sql,$conn) or die("更新数据失败：".mysql_error()) ;
?>
<div style="width:1300;height:568; text-align:center">
<img src="header1.jpg" ><br><br>
<font size="+3" color="#FF0000">修改折扣信息成功!</font><br>
<a href="#" onClick="window.history.go(-2)">返回</a>
</div>
<?php
require("footer.php");
?>