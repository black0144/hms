<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
require("dbconnect.php");
if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></p></div>";
require("footer.php");
exit();
}
?>
<div style="width:1300;height:568;text-align:center">
<?php
require("header.php");
//查询折扣信息
$sql="select * from discount order by level;";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
//输出折扣信息
echo"<br><table border=1 align='center'>";
echo "<tr><th>客人等级</th>";
echo "<th>折扣比例</th></tr>";
while($discount=mysql_fetch_array($result)){
echo"<td>$discount[level]</td>";
echo"<td>$discount[percent]</td></tr>";
}
echo "</table>";
?>
</div>
<?php
require("footer.php");
?>