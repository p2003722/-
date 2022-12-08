<?php
	session_start();
	require_once "database.php";
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "select id from users where username='$username' and password='$password'";
		$result = mysqli_query($database, $sql) or die(mysqli_error($database));
		if (mysqli_num_rows($result) == 0) {
			echo "<script>alert('用户名或密码错误，请重新输入！');history.back()</script>";
			exit;
		}

		$_SESSION['client'] = $username;
		echo "<script>location.href='index.php'</script>";
		mysqli_close($database); // 关闭数据库连接
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>用户登录</title>
	<style>
		.container {width: 400px;margin: 50px auto;text-align: center;}
		table{width: 400px;border: 1px solid #999;}
	</style>
</head>
<body>		
<div class="container">
   <h3>请登录</h3>
   <hr>
   <form action="" method="post">
    <table>
    	<tr>
			<td>用户名：</td>
			<td><input type="text" name="username" required /></td>
			<td></td>
		</tr>
		<tr>
			<td>密 码：</td>
			<td><input type="password" name="password" required /></td>
			<td></td>
		</tr>
    </table>
    <div>
		<input class="btn" type="submit" name="submit" value="登录"  />
		<input class="btn" type="reset" value="重置"  />
    </div>
    </form>
</div>
</body>
</html>