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
<?php
echo "<div style='width:1300;height:568; text-align:center'>";
echo "<img src='header1.jpg'><br><br>";
$bookid=$_GET['bookid'];
//查询预订信息
$sql="select * from book where bookid='$bookid';";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
$row=mysql_fetch_array($result);
//分配房间并修改数据库中的房间表和账单表信息，删除预定表信息
for($i=0;$i<$row[num];$i++){
//查询预订房间种类的空房间的房间号
$roomsql="select roomid from room where status='空房' && type='$row[type]';";
$result1=mysql_query($roomsql,$conn) or die("查询数据失败：".mysql_error());
$roomrow=mysql_fetch_array($result1);
//插入一个账单数据
$billsql="insert into bill(id,roomid,intime) values('$row[id]','$roomrow[roomid]','$row[bookintime]');";
mysql_query($billsql,$conn) or die("插入数据失败：".mysql_error());
//修改房间状态
$updateroomsql="update room set status='已入住' where roomid='$roomrow[roomid]';";
mysql_query($updateroomsql,$conn) or die("更新数据失败：".mysql_error());
//删除预订信息
$delbooksql="delete from book where bookid='$bookid';";
mysql_query($delbooksql,$conn) or die("删除数据失败：".mysql_error());
//输出已入住的房间号
echo "已入住的房间号为：$roomrow[roomid]<br>";
}
echo "<a href='#' onClick='window.history.go(-1)'>返回</a>";
echo "</div>";
require("footer.php");
?>
