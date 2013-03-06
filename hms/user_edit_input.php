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
$username=$_GET[username];
//从数据库中查询原来用户的信息
$sql="select * from user where username='$username';";
$result=mysql_query($sql,$conn)or die("查询数据失败:".mysql_error());
$row=mysql_fetch_array($result);
?>
<script language="javascript">
//验证所有项目不为空
function checkedit()
{
if((edit.username.value!="")&&(edit.password.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>
<!--取出原有用户信息添加在表单中-->
<form action="user_edit.php" method="post" name="edit" onSubmit="return checkedit()">
<p>用户名：<input type="text" name="username" value="<?php echo $row[username];?>" readonly> </p>
<p>密码：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="password" value="<?php echo $row[password];?>"></p>
<input type="submit" value="提交">
<input type="button" value="取消"  onClick="window.history.go(-1)">
</form>
</div>
<?php
require("footer.php");
?>