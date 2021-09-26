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
$bookid=$_POST['bookid'];
$name=$_POST['name'];
$id=$_POST['id'];
$type=$_POST['type'];
$num=$_POST['num'];
$bookintime=$_POST['bookintime'];
//先暂时将此预订的房间数量设置为0
$zerosql="update book set num='0' where bookid='$bookid';";
mysql_query($zerosql,$conn) or die("更新数据失败:".mysql_error());
//查询客人原来的身份证号
$oldidsql="select * from book where bookid='$bookid';";
$oldidresult=mysql_query($oldidsql,$conn) or die("查询数据失败：".mysql_error());
$oldidrow=mysql_fetch_array($oldidresult);
//先暂时删除此预订者的客人信息
$delcstmsql="delete from customer where id='$oldidrow[id]';";
mysql_query($delcstmsql,$conn)or die("删除数据失败：".mysql_error());
//查询此类型房间总数
$sumsql="select count(*)from room where type='$type';";
$result=mysql_query($sumsql,$conn) or die("查询数据失败：".mysql_error());
$row=mysql_fetch_row($result);
$sum=intval($row[0]);
//查询此类型房间在客户打算预订的时间已预订总数
$booksumsql="select sum(num)from book where type='$type'&&bookintime='$bookintime';";
$result1=mysql_query($booksumsql,$conn) or die("查询数据失败：".mysql_error());
$row1=mysql_fetch_row($result1);
$booksum=intval($row1[0]);
//此类型房间在当日的剩余总量
$leftsum=$sum-$booksum;
if($leftsum<$num){
require("header.php");
echo "<br><br><br><br><br><center><font color='red' size='+3'>".$type."剩余数量不足，当日还剩".$leftsum."间！</font></center><br><br><br><br><br><br><br><br><br><br><br>";
require("footer.php");
}
else{
$sql="update book set id='$id',type='$type',num='$num',bookintime='$bookintime' where bookid='$bookid';";
mysql_query($sql,$conn) or die("更新数据失败：".mysql_error());//更新数据到book表（预订表）
$customersql="insert into customer(id,name) values('$id','$name');";
mysql_query($customersql,$conn) or die("插入数据失败：".mysql_error());//插入数据到customer表（客户表）
mysql_close($conn);
}
?>
<div style="width:1300;height:568; text-align:center">
<img src="header1.jpg" ><br><br>
<font size="+3" color="#FF0000">修改预订成功!</font><br>
<a href="#" onClick="window.history.go(-2)">返回</a>
</div>
<?php
require("footer.php");
?>