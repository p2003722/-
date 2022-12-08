<?php
session_start();
require_once "database.php";

$sql = "delete from client where id=" . $_GET['id'];
$result = mysqli_query($database, $sql) or die(mysqli_error($database));


if ($result) {
    echo "<script>alert('删除成功');location.href='index.php'</script>";
} else {
    echo "<script>alert('删除失败');history.back()</script>";
}

mysqli_close($database); // 关闭数据库连接
?>