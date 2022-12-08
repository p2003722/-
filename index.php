<?php
require_once 'database.php';//引入数据库配置文件
session_start();
if (!isset($_SESSION['client'])) {
    echo "<script>alert('请先登录');location.href='login.php';</script>";
    exit;
}

$sql = "select * from client";
$result = mysqli_query($database, $sql) or die(mysqli_error($database));
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>客户消费积分管理系统</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .head {
            text-align: center;
            padding-top: 20px;
        }

        .head a {
            color: #2196f3;
            text-decoration: none;
        }

        .container {
            width: 1200px;
            margin: 50px auto;
            border: 1px solid #2196f3;
            border-radius: 5px;
        }

        .container .title {
            font-size: 30px;
            padding-left: 15px;
            color: #fff;
            background-color: #4a96d3;
            line-height: 80px;
        }

        .container table {
            width: 100%;
            padding: 15px 0 50px 15px;
        }

        .container table td {
            height: 40px;
            padding-left: 10px;
        }

        #button {
            padding: 0;
        }

        #button a {
            padding: 6px 10px;
            color: #008dff;
            background-color: #8acb8d;
            border-radius: 5px;
            text-decoration: none;
        }

        .table {
            border-bottom: 2px solid #e9e9e9;
            text-align: center;
        }
		
        .main td {
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .btn {
            border-bottom: 2px solid #e9e9e9;
            text-align: center;
        }

        .btn a {
            color: #2196f3;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="head">
    欢迎你，<?php echo $_SESSION['client']; ?>
    <a href="logout.php">【退出登录】</a>
</div>
<div class="container">
<p class="title">客户消费积分管理系统</p>
    <table cellspacing="0">
        <tr>
            <td id="button" colspan="0" >
                <a href="add.php">添加客户</a>
                &#12288;
                <a href="search.php">搜索客户</a>
                &#12288;
                <a href="upload.php">导入客户</a>
                &#12288;
                <a href="download.php">导出客户</a>
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td class="table">客户姓名</td>
			<td class="table">客户性别</td>
            <td class="table">客户电话</td>
            <td class="table">客户积分</td>
            <td class="table">客户等级</td>
			<td class="table">客户折扣</td>
            <td class="table">操作</td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="main">
                <td class="table"><?php echo $row['name']; ?></td>
                <td class="table"><?php echo $row['sex']; ?></td>
                <td class="table"><?php echo $row['tel']; ?></td>
                <td class="table"><?php echo $row['balabce']; ?></td>
				<td class="table"><?php
					$score = $row['balabce'];
					if($score<10){
					  $level ='心悦V1';
					}elseif($score>=10 && $score<100) {
					  $level='心悦V2';
					}elseif($score>=100 && $score<1000) {
					  $level='心悦V3';
					}elseif($score>=1000 && $score<10000) {
					  $level='心悦V4';
					}else {
					$level='心悦V5';
					}echo $level;
				?></td>
				<td class="table"><?php
					$score = $row['balabce'];
					if($score<10){
					  $discount ='98折';
					}elseif($score>=10 && $score<100) {
					  $discount='95折';
					}elseif($score>=100 && $score<1000) {
					  $discount='92折';
					}elseif($score>=1000 && $score<10000) {
					  $discount='88折';
					}else {
					$discount='85折';
					}echo $discount;
				?></td>
                <td class="btn">
                    <a href="edit.php?id=<?php echo $row['id']; ?>">编辑</a>
                    <a>&#8194;</a>
					<a href="calculate.php?id=<?php echo $row['id']; ?>">积分</a>
                    <a>&#8194;</a>
                    <a href="javascript:del(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>')">删除</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
<script>
    function del(id, name) {
        if (confirm('你确认要删除该客户：' + name + ' 吗')) {
            location.href = 'delete.php?id=' + id;
        }
    }
</script>