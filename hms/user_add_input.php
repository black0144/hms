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
?>
<script language="javascript">
//验证所有项目不为空
function checkbook()
{
if((user_add.username.value!="")&&(user_add.password.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>
<form action="user_add.php" method="post" name="user_add" onSubmit="return checkbook()">
<p>用户名：<input type="text" name="username"> </p>
<p>密码：<input type="password" name="password"></p>
<input type="submit" value="添加">
<input type="button" value="取消"  onClick="window.history.go(-1)">
</form>
</div>
<?php
require("footer.php");
?>