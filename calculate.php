<?php
session_start();
require_once "database.php";//引入数据库配置文件

$sql = "select * from client where id=" . $_GET['id'];
$result = mysqli_query($database, $sql) or die(mysqli_error($database));
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>积分增减</title>
</head>
<body>
<div style="width: 400px;margin: 0 auto">
    <h3>增减积分</h3>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <table width="300">
            <tr>
                <td>客户姓名：</td>
                <td><?php echo $row['name']; ?></td>
            </tr>
			<tr>
            <tr>
                <td>当前积分：</td>
                <td><?php echo $row['balabce']; ?></td>
            </tr>
			<tr>
				<td>操作类型：</td>
				<td>
					<input type="radio" name="calculate" value="+" /> 增加
					<input type="radio" name="calculate" value="-" /> 扣除
				</td>
			</tr>
			<tr>
                <td>变更数量：</td>
                <td><input type="text" name="number" required/></td>
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

<?php
if (isset($_POST['submit'])) {
		
	if($_POST['calculate'] == "+"){
		$balabce = $row['balabce'] + $_POST['number'];
	}else if($_POST['calculate'] == "-"){
		$balabce = $row['balabce'] - $_POST['number'];
	}
	
	$sql = "update client set balabce='$balabce' where id=" . $_POST['id'];
	$result = mysqli_query($database, $sql) or die(mysqli_error($database));
	
	if ($balabce < 0) {
		echo "<script>alert('客户积分已小于0，请注意');</script>";
	}
	
	if ($result) {
		echo "<script>alert('操作成功');location.href='index.php'</script>";
	} else {
		echo "<script>alert('操作失败');history.back()</script>";
	}

	}
	
	mysqli_close($database); // 关闭数据库连接
	exit;
?>