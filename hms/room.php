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
<div style="width:1300;height:568; text-align:center">
<?php
require("header1.php");
//查看房间总数
$sql="select * from room;";
$result=mysql_query($sql,$conn) or die("查询数据失败：".mysql_error());
$num=mysql_num_rows($result);
//定义每页显示房间数目，若总房间数大于它，则分页显示
$page_size=12;
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
//查询房间数据，只取出一页的数据
$sqlpage="select * from room order by roomid limit ".($page-1)*$page_size.",$page_size;";
$re_page=mysql_query($sqlpage,$conn) or die("查询数据失败：".mysql_error());
echo"<table border=1 align='center'>";
echo "<tr><th>房间号</th>";
echo "<th>类型</th>";
echo "<th>价格</th>";
echo "<th>电话</th>";
echo "<th>状态</th>";
echo "<th>描述</th>";
echo "<th>操作</th></tr>";
while($row=mysql_fetch_array($re_page)){
echo"<tr><td>$row[roomid]</td>";
echo"<td>$row[type]</td>";
echo"<td>$row[price]</td>";
echo"<td>$row[tel]</td>";
echo"<td>$row[status]</td>";
echo"<td>$row[desc]</td>";
echo "<td>"
?>
<input type="button" name="edit" value="修改" onclick="location.href='room_edit_input.php?roomid=<?php echo $row[roomid]?>'">
<input type="button" name="delete" value="删除" onClick="if(confirm('确定要删除此房间？')) location.href='room_del.php?roomid=<?php echo $row[roomid]?>'">
</td></tr>
<?php
}
echo "</table>";
echo "<a href='room_add_input.php'>添加房间信息</a>&nbsp;&nbsp;";
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