<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="referrer" content="no-referrer"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>index</title>
    <style>
    </style>
</head>
<body>
<? error_reporting(E_ERROR);
ini_set("display_errors","Off");?>

<?php

# 首先先获取POST请求然后在处理数据库
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "test";

// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($conn,"utf8");
mysqli_query($conn,"set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
// 检测连接
if ($conn->connect_error) {
    die("error " . $conn->connect_error);
}


function filterWords(&$str)
{
    $farr = array(
        "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        "/select\b|insert\b|update\b|delete\b|drop\b|;|\"|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
    );
    $str = preg_replace($farr,'',$str);
    $str = strip_tags($str);
    return $str;
}

$filename = $_POST['filename'];
$filecontent = $_POST['filecontent'];

# 对post请求进行过滤

$filename_filter = filterWords($filename);
filterWords($filecontent);


# 对post请求进行过滤
function string2bytes($str){
    $bytes=array();
    for ($i=0; $i < strlen($str); $i++) {
        $tmp=substr($str, $i,1);
        $bytes[]=bin2hex($tmp);
    }
    return $bytes;
}

$ar = string2bytes($filecontent);
$filecontent_filter_bytes = implode("",$ar);


$sql = "INSERT INTO testx (virus, virus_content) VALUES (" . "'{$filename_filter}',"."'{$filecontent}'".")";

if (!empty($filename) && !empty($filecontent)){
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn) == 1){
        //如果影响成功
        echo "<script language=JavaScript> location.replace(location.href);</script>";
    }else{
        //如果错误先回滚
        mysqli_rollback($conn);
        //最终关闭数据库
        mysqli_close($conn);
        // 结束指令
        return false;
    }
}

$conn->close();
?>

<nav id="nav" class="navbar navbar-default" style="margin-bottom: 0px;min-height: 43px;">
</nav>
<div class="container" style="background: rgba(255, 255, 255, 0.5);padding-top: -3px">
    <div class="panel panel panel-success " id="form">
        <form action="authenticate.php" method="post"
              enctype="multipart/form-data">
            <label for="filename">文件名</label>
            <input type="text" class="form-control"  name="filename">
            <br/>
            <label for="filename">病毒内容</label>
            <input type="text" class="form-control"  name="filecontent">
            <br>
            <input type="submit" name="submit" value="提交"/>
        </form>

    </div>
    <div class="panel panel panel-success" id="show">
        <ul class="list-group ">
        </ul>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
</html>