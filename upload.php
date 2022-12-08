<?php

echo "<script>alert('该功能尚未开发完成');location.href='index.php';</script>";

require_once 'database.php';//引入数据库配置文件
session_start();

$sql = "select * from client";
$result = mysqli_query($database, $sql) or die(mysqli_error($database));

if(!isset($_FILES['file']['tmp_name']))
{
    exit;
}

if ( $_FILES['file']['error'][0] != 0 ){
    echo "上传".$_FILES['file']['name'][0]."失败";
    exit;
}

$bytesize = $_FILES['file']['size'][0];    
if( $bytesize > 1024*1024 ){ 
    echo "文件".$_FILES['file']['name'][0]."大小超过1M, 上传失败";
    exit;
}
      
$name = $_FILES['file']['name'];
if(!$name){
    echo "文件名为空, 上传失败";
    exit;       
}

$ext = pathinfo($name, PATHINFO_EXTENSION);
if(!$ext=='csv'){
    echo "文件".$name."格式错误";
    exit;
}

$classify_dir ='/';

if ( move_uploaded_file($_FILES['file']['tmp_name'], $upload.csv) ) {
    header('Location: index.php');
} else {
    exit;
}

?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
	<style>
        *{
            padding: 0;
            margin: 0;
        }

        a{
            color: black;
            text-decoration: none;
        }
	</style>
</head>
<body>

	<a href="index.php">主页</a>
	
	<form enctype="multipart/form-data" action="process_file_upload.php" method="post">

		<input type="file" name='file'>
		<button type="submit">上传</button>

	</form>
	<!-- 提交表单 -->

</body>
</html>