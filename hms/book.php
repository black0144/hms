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
$bookintime=$_POST['bookintime'];
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
echo "<div style='width:1300;height:530; text-align:center'>";
require("header.php");
echo "<br><br><br><br><br><center><font color='red' size='+3'>".$type."剩余数量不足，当日还剩".$leftsum."间！</font></center><br><br><br><br><br><br><br><br><br><br><br>";
echo "</div>";
require("footer.php");
}
else{
$sql="insert into book (id,type,num,bookintime) values('$id','$type','$num','$bookintime');";
mysql_query($sql,$conn) or die("插入数据失败：".mysql_error());//插入数据到book表（预订表）
$cstmidsql="select * from customer where id='$id';";
$result=mysql_query($cstmidsql,$conn) or die("查询数据失败：".mysql_error());
$num=mysql_num_rows($result);//查出提交的身份证号是否已经在customer表（客人表）中存在
if($num==0)//若身份证号不在表中，则插入新数据到表中
{
$customersql="insert into customer(id,name) values('$id','$name');";
mysql_query($customersql,$conn) or die("插入数据失败：".mysql_error());//插入数据到customer表（客户表）
}
mysql_close($conn);
echo"<div style=\"width:1300;height:568;text-align:center\">";
require("header.php");
echo "<br><br><br><center><font color='red' size='+5'>提交成功</font></center><br><br><br><br><br><br><br><br><br><br><br>";
echo"</div>";
require("footer.php");
}
?>
