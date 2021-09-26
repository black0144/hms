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
$roomid=$_GET[roomid];
//从数据库中查询原来房间的信息
$sql="select * from room where roomid='$roomid';";
$result=mysql_query($sql,$conn)or die("查询数据失败:".mysql_error());
$row=mysql_fetch_array($result);
?>
<script language="javascript">
//验证所有项目不为空
function checkedit()
{
if((edit.roomid.value!="")&&(edit.type.value!=="")&&(edit.price.value!=="")&&(edit.tel.value!=="")&&(edit.status.value!==""))
return true;
else{
alert("请填完所有项目！");
return false;
}
}
</script>
<!--取出原有用户信息添加在表单中-->
<form action="room_edit.php" method="post" name="edit" onSubmit="return checkedit()">
<p>房间号：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="roomid" value="<?php echo $row[roomid];?>" readonly> </p>
<p>房间类型：<input type="text" name="type" value="<?php echo $row[type];?>"></p>
<p>价格：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="price" value="<?php echo $row[price];?>"></p>
<p>电话：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tel" value="<?php echo $row[tel];?>"></p>
<p>状态：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="status" value="<?php echo $row[status];?>"></p>
<p>描述：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="desc" value="<?php echo $row[desc];?>"><br><font size="-1" color="#FF0000">描述可为空</font></p>
<input type="submit" value="提交">
<input type="button" value="取消"  onClick="window.history.go(-1)">
</form>
</div>
<?php
require("footer.php");
?>