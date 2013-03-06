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
echo "<div style='width:1300;height:568;text-align:center'>";
echo "<img src='header1.jpg'><br><br>";
$roomid=$_GET['roomid'];
//查询账单信息
$sql="select * from bill where roomid='$roomid';";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
$bill=mysql_fetch_array($result);
//查询房间信息
$sql1="select * from room where roomid='$roomid';";
$result1=mysql_query($sql1,$conn) or die("查询数据失败：".mysql_error());
$room=mysql_fetch_array($result1);
//查询客人信息
$sql4="select * from customer where id='$bill[id]';";
$result4=mysql_query($sql4,$conn) or die("查询数据失败：".mysql_error());
$cstm=mysql_fetch_array($result4);
//查询折扣信息
$sql5="select * from discount where level='$cstm[level]';";
$result5=mysql_query($sql5,$conn) or die("查询数据失败：".mysql_error());
$discount=mysql_fetch_array($result5);
$percent=$discount['percent'];
//消费金额
$intime=$bill['intime'];
$outtime=date("Y-m-d");
$day=(strtotime($outtime)-strtotime($intime))/86400;
$price=$room['price'];
$money=$day*$price*$percent;
//将此订单信息存到数据库的report表中
$report="insert into report(billid,id,name,roomid,intime,outtime,money) values('$bill[billid]','$bill[id]','$cstm[name]','$bill[roomid]','$bill[intime]','$outtime','$money');";
mysql_query($report,$conn) or die("插入数据失败：".mysql_error());
//删除此账单数据
$sql2="delete from bill where roomid='$roomid';";
mysql_query($sql2,$conn) or die("删除数据失败：".mysql_error());
//修改房间状态
$sql3="update room set status='空房' where roomid='$roomid';";
mysql_query($sql3,$conn) or die("修改数据失败：".mysql_error());
//输出消费金额
echo "客人消费的金额为：".$money."元<br><br>";
echo "<a href='#' onClick='window.history.go(-1)'>返回</a>";
echo "</div>";
require("footer.php");
?>