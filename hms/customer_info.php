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
?>
<script language="javascript">
//验证所有项目不为空
function check()
{
if(search.info.value!="")
return true;
else{
alert("请填写搜索内容！");
return false;
}
}
</script>
<!--准确搜索客人信息-->
<form  name="search" method="get" action="customer_info.php"  onSubmit="return check()">
<font size="+2" color="#FF0000">请输入客人身份证号或客人姓名来搜索:</font>
<input type="text" name="info" size="30">&nbsp;
<input type="submit" value="搜索"><br>
</form>
<?php
$info=$_GET['info'];
$sql="select * from customer where id like '%$info%' or name like '%$info%';";
$result=mysql_query($sql,$conn)or die("查询数据失败：".mysql_error());
$num=mysql_num_rows($result);
if($num==0){
echo "<br><br><br><center><font color ='red' size='+1'>没有查询到符合条件的客户!</font></center>";
}
else{
//输出客人信息
echo"<table border=1,width=80% align='center'>";
echo "<tr><th>客人身份证号</th>";
echo "<th>客人姓名</th>";
echo "<th>客人等级</th></tr>";
while($customer=mysql_fetch_array($result)){
echo"<td>$customer[id]</td>";
echo"<td>$customer[name]</td>";
echo"<td>$customer[level]</td></tr>";
}
echo "</table>";
}
?>
</div>
<?php
require "footer.php";
?>