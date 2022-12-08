<?php
	session_start();
	require_once "database.php";//引入数据库配置文件
	
	if (isset($_POST['submit'])){
	
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$tel = $_POST['tel'];
		$balabce = $_POST['balabce'];
		
		if(preg_match('/^1[345789]\d{9}$/ims', $tel)){
				
			$sql = "insert into client(name,sex,tel,balabce) value('$name','$sex','$tel','$balabce')";
			$result = mysqli_query($database, $sql) or die(mysqli_error($database));
			
			if (mysqli_insert_id($database)) {
				echo "<script>alert('添加成功');location.href='index.php'</script>";
			} else {
				echo "<script>alert('添加失败');history.back()</script>";
			}
			
		} else {
			echo "<script>alert('手机号格式错误');history.back()</script>";
		}
			
		mysqli_close($database); // 关闭数据库连接
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>客户添加</title>
</head>
<body>		
<div style="width: 400px;margin: 0 auto">
   <h3>添加客户</h3>
   <hr>
   <form action="" method="post">
    <table width="300">
    	<tr>
			<td>客户姓名：</td>
			<td><input type="text" name="name" required /></td>
		</tr>
    	<tr>
		<tr>
			<td>客户性别：</td>
			<td>
				<input type="radio" name="sex" value="男" /> 男
				<input type="radio" name="sex" value="女" /> 女
			</td>
		</tr>
		<tr>
			<td>客户电话：</td>
			<td><input type="text" name="tel" required /></td>
		</tr>
    	<tr>
			<td>客户积分：</td>
			<td><input type="text" name="balabce" required /></td>
		</tr>
    </table>
    <div>
		<input type="button" value="取消" onclick="history.back()" />
		<input type="submit" name="submit" value="确定"  />
    </div>
    </form>
</div>
</body>
</html>