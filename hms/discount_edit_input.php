<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
require("dbconnect.php");
if(!isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></p></div>>";
require("footer.php");
exit();
}
?>
<div style="width:1300;height:568; text-align:center">
<?php
require("header1.php");
$level=$_GET[level];
//从数据库中查询原来折扣的信息
$sql="select * from discount where level='$level';";
$result=mysql_query($sql,$conn)or die("查询数据失败:".mysql_error());
$row=mysql_fetch_array($result);
?>
<script language="javascript">
//验证所有项目不为空
function checkedit()
{
if((edit.level.value!="")&&(edit.percent.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>
<!--取出原有折扣信息添加在表单中-->
<form action="discount_edit.php" method="post" name="edit" onSubmit="return checkedit()">
<p>客人等级：<input type="text" name="level" value="<?php echo $row[level];?>" readonly> </p>
<p>折扣比例：<input type="text" name="percent" value="<?php echo $row[percent];?>"></p>
<input type="submit" value="提交">
<input type="button" value="取消"  onClick="window.history.go(-1)">
</form>
</div>
<?php
require("footer.php");
?>