<?php
@header("Content-type: text/html; charset=utf-8");

// 连接数据库
$database = @mysqli_connect('localhost', 'keshe', 'TkBBnTWScTjLPbef', 'keshe') or die('数据库连接失败：' . mysqli_connect_error());
mysqli_set_charset($database, 'utf8');
?>