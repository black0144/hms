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
$name=$_POST['name'];
$id=$_POST['id'];
$type=$_POST['type'];
$num=$_POST['num'];
$intime=date("Y-m-d");
//查询此类型房间空房总数
$sumsql="select count(*)from room where type='$type' && status='空房';";
$result=mysql_query($sumsql,$conn) or die("查询数据失败：".mysql_error());
$row=mysql_fetch_row($result);
$sum=intval($row[0]);
//查询此类型房间在今天已预订总数
$booksumsql="select sum(num)from book where type='$type'&&bookintime='$intime';";
$result1=mysql_query($booksumsql,$conn) or die("查询数据失败：".mysql_error());
$row1=mysql_fetch_row($result1);
$booksum=intval($row1[0]);
//此类型房间在今天的剩余总量
$leftsum=$sum-$booksum;
if($leftsum<$num){
echo "<div style='width:1300;height:530; text-align:center'>";
require("header.php");
echo "<br><br><br><br><br><center><font color='red' size='+3'>".$type."剩余数量不足，今天还剩".$leftsum."间！</font></center><br><br><br><br><br><br><br><br><br><br><br>";
require("footer.php");
echo "</div>";
exit();
}
echo "<div style='width:1300;height:568; text-align:center'>";
require("header.php");
//插入客户表信息
$cstmidsql="select * from customer where id='$id';";
$result2=mysql_query($cstmidsql,$conn) or die("查询数据失败：".mysql_error());
$idnum=mysql_num_rows($result2);//查出提交的身份证号是否已经在customer表（客人表）中存在
if($idnum==0)//若身份证号不在表中，则插入新数据到表中
{
$customersql="insert into customer(id,name) values('$id','$name');";
mysql_query($customersql,$conn) or die("插入数据失败：".mysql_error());//插入数据到customer表（客户表）
}
//分配房间并修改数据库中的房间表和账单表信息
for($i=0;$i<$num;$i++){
//查询预订房间种类的空房间的房间号
$roomsql="select roomid from room where status='空房' && type='$type';";
$result3=mysql_query($roomsql,$conn) or die("查询数据失败：".mysql_error());
$roomrow=mysql_fetch_array($result3);
//插入一个账单数据
$billsql="insert into bill(id,roomid,intime) values('$id','$roomrow[roomid]','$intime');";
mysql_query($billsql,$conn) or die("插入数据失败：".mysql_error());
//修改房间状态
$updateroomsql="update room set status='已入住' where roomid='$roomrow[roomid]';";
mysql_query($updateroomsql,$conn) or die("更新数据失败：".mysql_error());
//输出已入住的房间号
echo "已入住的房间号为：$roomrow[roomid]<br>";
}
echo"<a href='#' onClick='window.history.go(-1)'>返回</a>";
echo "</div>";
require("footer.php");
?>