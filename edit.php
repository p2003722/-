<?php
	session_start();
	require_once "database.php";//引入数据库配置文件

	if (isset($_POST['submit'])) {
		
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$tel = $_POST['tel'];
		$balabce = $_POST['balabce'];

		if(preg_match('/^1[345789]\d{9}$/ims', $tel)){
				
			$sql = "update client set name='$name',sex='$sex',tel='$tel',balabce='$balabce' where id=" . $_POST['id'];
			$result = mysqli_query($database, $sql) or die(mysqli_error($database));
			
			if ($result) {
				echo "<script>alert('修改成功');location.href='index.php'</script>";
			} else {
				echo "<script>alert('修改失败');history.back()</script>";
			}
		
		} else {
			echo "<script>alert('手机号格式错误');history.back()</script>";
		}
			
		mysqli_close($database); // 关闭数据库连接
		exit;
	}

$sql = "select * from client where id=" . $_GET['id'];
$result = mysqli_query($database, $sql) or die(mysqli_error($database));
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>客户修改</title>
</head>
<body>
<div style="width: 400px;margin: 0 auto">
    <h3>修改客户</h3>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <table width="300">
            <tr>
                <td>客户姓名：</td>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>" required/></td>
            </tr>
			<tr>
			<tr>
				<td>客户性别：</td>
				<td>
					<input type="radio" name="sex" value="男" /> 男
					<input type="radio" name="sex" value="女" /> 女
				</td>
			</tr>
                <td>客户电话：</td>
                <td><input type="text" name="tel" value="<?php echo $row['tel']; ?>" required/></td>
            </tr>
            <tr>
                <td>客户积分：</td>
                <td><input type="text" name="balabce" value="<?php echo $row['balabce']; ?>" required/></td>
            </tr>
        </table>
        <div>
            <input type="button" value="取消" onclick="history.back()"/>
            <input type="submit" name="submit" value="确定"/>
        </div>
    </form>
</div>
</body>
</html>