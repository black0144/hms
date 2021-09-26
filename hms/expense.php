<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
require("dbconnect.php");
if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></div>";
require("footer.php");
exit();
}
?>
<div style="width:1300;height:568;text-align:center">
<?php
require("header.php");
//查看账单总数
$sql="select * from bill;";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
$num=mysql_num_rows($result);
//定义每页账单数目，若总账单数大于它，则分页显示
$page_size=10;
if($num<=$page_size){
$page_count=1;
}
if($num%$page_size){
$page_count=(int)($num/$page_size)+1;
}
else{
$page_count=$num/$page_size;
}
//获得当前页数
if(isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
//查询账单，只取出一页的数据
$sqlpage="select * from bill order by roomid limit ".($page-1)*$page_size.",$page_size;";
$re_page=mysql_query($sqlpage,$conn) or die("查询数据失败：".mysql_error());
echo"<br><table border=1 align='center'>";
echo "<tr><th>房间号</th>";
echo "<th>房间类型</th>";
echo "<th>身份证号</th>";
echo "<th>姓名</th>";
echo "<th>入住时间</th>";
echo "<th>客房消费</th></tr>";
while($bill=mysql_fetch_array($re_page)){
//查询客人信息
$cstmsql="select * from customer where id='$bill[id]'; ";
$result1=mysql_query($cstmsql,$conn) or die("查询数据失败:".mysql_error());
$cstm=mysql_fetch_array($result1);
//查询房间信息
$roomsql="select * from room where roomid='$bill[roomid]'; ";
$result2=mysql_query($roomsql,$conn) or die("查询数据失败:".mysql_error());
$room=mysql_fetch_array($result2);
//查询折扣信息
$sql3="select * from discount where level='$cstm[level]';";
$result3=mysql_query($sql3,$conn) or die("查询数据失败：".mysql_error());
$discount=mysql_fetch_array($result3);
$percent=$discount['percent'];
//消费金额
$intime=$bill['intime'];
$outtime=date("Y-m-d");
$day=(strtotime($outtime)-strtotime($intime))/86400;
$price=$room['price'];
$money=$day*$price*$percent;
//输出客房消费信息
echo"<tr><td>$bill[roomid]</td>";
echo"<td>$room[type]</td>";
echo"<td>$bill[id]</td>";
echo"<td>$cstm[name]</td>";
echo"<td>$bill[intime]</td>";
echo "<td>$money</td></tr>";
}
echo"</table>";
//如果页数大于1，列出所有页数
if($page_count>1){
echo "页数：";
for($j=1;$j<=$page_count;$j++){
if($j==$page){echo $j;}
else{echo "<a href=?page=$j>$j</a>";}
}
}
?>
</div>
<?php
require("footer.php");
?>
