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
if((room_add.roomid.value!="")&&(room_add.type.value!=="")&&(room_add.price.value!=="")&&(room_add.tel.value!=="")&&(room_add.status.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>
<form action="room_add.php" method="post" name="room_add" onSubmit="return checkbook()">
<p>房间号：<input type="text" name="roomid"> </p>
<p>类型：<input type="text" name="type"></p>
<p>价格：<input type="text" name="price"></p>
<p>电话：<input type="text" name="tel"></p>
<p>状态：<input type="text" name="status"></p>
<p>描述：<input type="text" name="desc"><br><font size="-1" color="#FF0000">描述可为空</font></p>
<input type="submit" value="添加">
<input type="button" value="取消"  onClick="window.history.go(-1)">
</form>
</div>
<?php
require("footer.php");
?>