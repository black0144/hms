<?php
header("content-type:text/html;charset=utf-8");
session_start();
//已登录管理员账号，跳转到admin_index.php
if(isset($_SESSION['admin'])){
header("location:admin_index.php");
exit;
}
//已登录用户账号，跳转到user_index.php
if(isset($_SESSION['user'])){
header("location:user_index.php");
exit;
}
?>
<title>酒店管理系统登录</title>
</head>
<script language="javascript">
//利用javascript代码验证用户名和密码不为空
function checklogin()
{
if((login.username.value!="")&&(login.password.value!==""))
return true;
else{
alert("用户名或密码不能为空！");
return false;
}
}
</script>
<div style="width:1300;height:568;text-align:center">
<p align="center"><img src="header1.jpg" ></p>
<form action="login.php" method="post" name="login" onSubmit="return checklogin()">
<p align="center"><strong>用户登录</strong></p>
<table align="center" border="0" style="text-align:left"> 
<tr><th>用户名:</th><th><input type="text" name="username" size="20"></th></tr>
<tr><th>密&nbsp;&nbsp;&nbsp;码：</th><th><input type="password" name="password" size="21"></th></tr>
<tr><th colspan="2" align="right"><input type="submit" value="登录"></th></tr>
</table>
</form>
</div>
<?php
require("footer.php");
?>
</html>
