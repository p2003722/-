<?php
require_once 'database.php';//引入数据库配置文件
session_start();

$sql = "select * from client";
$result = mysqli_query($database, $sql) or die(mysqli_error($database));

$myfile = fopen("download.csv", "w") or die("Unable to open file!");
$txt = "客户姓名,";
fwrite($myfile, $txt);
$txt = "客户性别,";
fwrite($myfile, $txt);
$txt = "客户电话,";
fwrite($myfile, $txt);
$txt = "客户积分,\n";
fwrite($myfile, $txt);
while ($row = mysqli_fetch_assoc($result)) { 
    $txt = "$row[name],";
    fwrite($myfile, $txt);
    $txt = "$row[sex],";
    fwrite($myfile, $txt);
    $txt = "$row[tel],";
    fwrite($myfile, $txt);
    $txt = "$row[balabce],\n";
    fwrite($myfile, $txt);
}
fclose($myfile);

require "transform.php";
$str = file_get_contents('download.csv');
$obj = new CharsetConv('utf-8', 'ansi');
$response = $obj->convert($str);
file_put_contents('download.csv', $response, true);
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>数据导出</title>
    <style>

        .container {
            width: 1200px;
            margin: 50px auto;
        }

        .container .title {
            font-size: 30px;
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

    </style>
</head>
<body>
<div class="container">
<p class="title">数据导出</p>
    <table cellspacing="0">
        </tr>
            <td>
            </td>
        </tr>
        <tr>
            <td id="button" colspan="0" >
                <a href="download.csv">下载文件</a>
                &#12288;
                <a href="index.php">返回主页</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>