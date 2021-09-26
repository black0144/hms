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
echo "<th>操作</th></tr>";
while($row=mysql_fetch_array($re_page)){
$cstmsql="select name from customer where id='$row[id]'; ";
$result1=mysql_query($cstmsql,$conn) or die("查询数据失败:".mysql_error());
$cstm=mysql_fetch_array($result1);
$roomsql="select type from room where roomid='$row[roomid]'; ";
$result2=mysql_query($roomsql,$conn) or die("查询数据失败:".mysql_error());
$room=mysql_fetch_array($result2);
echo"<tr><td>$row[roomid]</td>";
echo"<td>$room[type]</td>";
echo"<td>$row[id]</td>";
echo"<td>$cstm[name]</td>";
echo"<td>$row[intime]</td>";
?>
<td><input type="button" name="checkout" value="结账" onclick="if(confirm('确定要为客人<?php echo $cstm[name] ?>结账吗？')) location.href='checkout.php?roomid=<?php echo $row[roomid]?>'"></td></tr>
<?php 
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
