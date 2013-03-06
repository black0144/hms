<?php
//验证用户是否登录
header("content-type:text/html;charset=utf-8");
session_start();
if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
echo "<div style=\"width:1300;height:568 \">";
echo "<p align='center'><img src='header1.jpg'></p>";
echo"<p align='center'><font size='5'>用户没有登录，请<a href='index.php'>登录</a></font></p></div>";
require("footer.php");
exit();
}
?>
<div style="width:1300;height:568;text-align:center;">
<?php
require("header.php");
?>
<script language="javascript">
//验证所有项目不为空
function checkarrive()
{
if((arrive.name.value!="")&&(arrive.id.value!=="")&&(arrive.type.value!=="")&&(arrive.num.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>

<form action="arrive.php" method="post" name="arrive" onSubmit="return checkarrive()">
<table  border="0" align='center' cellpadding="15">
<tr><td align="right">姓名：</td><td><input type="text" name="name"></td></tr>
<tr><td align="right">身份证：</td><td><input type="text" name="id"></td></tr>
<tr><td align="right">选择房间类型：</td><td><select name="type">
<option>--请选择--</option>
<option value="单人间">单人间</option>
<option value="双人间">双人间</option>
<option value="标准间">标准间</option>
<option value="豪华间">豪华间</option>
</select></td></tr>
<tr><td align="right">选择房间数量：</td><td><input type="text" name="num" value="1"></td></tr>
</table>
<input type="submit" value="提交">
</form>
</div>
<?php
require("footer.php");
?>
