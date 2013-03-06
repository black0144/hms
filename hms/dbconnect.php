<?php
//连接和选择数据库，设置操作mysql编码为utf-8
header("content-type:text/html;charset=utf-8");
$conn=mysql_connect("localhost","root","842137077") or die("无法连接数据库:".mysql_error());
mysql_query("set names utf8");
mysql_select_db("hms",$conn) or die ("不能选择数据库:".mysql_error());
?>
