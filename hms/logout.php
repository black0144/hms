<?php
//注销登录
session_start();
session_unset();
session_destroy();
header("location:index.php");
?>
