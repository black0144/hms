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
<div style="width:1300;height:568; text-align:center">
<?php
require("header.php");
$today=date("Y-m-d");
//查看预订今天房间的订单总数
$sql="select * from book where bookintime='$today';";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
$num=mysql_num_rows($result);
//定义每页显示订单数目，若总订单数大于它，则分页显示
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
//查询预订房间订单，只取出一页的数据
$sqlpage="select * from book where bookintime='$today' order by bookid limit ".($page-1)*$page_size.",$page_size;";
$re_page=mysql_query($sqlpage,$conn) or die("查询数据失败：".mysql_error());
echo"<br><table border=1 align='center'>";
echo "<th>预订编号</th>";
echo "<th>身份证号</th>";
echo "<th>姓名</th>";
echo "<th>房间类型</th>";
echo "<th>预计入住时间</th>";
echo "<th>房间数量</th>";
echo "<th>操作</th>";
while($row=mysql_fetch_array($re_page)){
$cstmsql="select name from customer where id in(select id from book where bookid=$row[bookid]); ";
$result1=mysql_query($cstmsql,$conn) or die("查询数据失败:".mysql_error());
$cstm=mysql_fetch_array($result1);
echo"<tr><td>$row[bookid]</td>";
echo"<td>$row[id]</td>";
echo"<td>$cstm[name]</td>";
echo"<td>$row[type]</td>";
echo"<td>$row[bookintime]</td>";
echo"<td>$row[num]</td>";
echo "<td>"
?>
<input type="button" name="arrive" value="预订入住" onclick="if(confirm('确定为客人 <?php echo"$cstm[name]" ?> 入住吗？')) location.href='book_arrive.php?bookid=<?php echo $row[bookid]?>'">
</td></tr>
<?php
}
echo "</table>";
echo "<center>";
//如果页数大于1，列出所有页数
if($page_count>1){
echo "页数：";
for($j=1;$j<=$page_count;$j++){
if($j==$page){echo $j;}
else{echo "<a href=?page=$j>$j</a>";}
}
}
echo "</center>";
?>
</div>
<?php
require("footer.php");
?>