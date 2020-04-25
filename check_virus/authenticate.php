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



<? error_reporting(0);
ini_set("display_errors", "Off"); ?>

<?php


if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
$un_temp = $_SERVER['PHP_AUTH_USER'];
$pw_temp = $_SERVER['PHP_AUTH_PW'];

if ($un_temp == "admin" && $pw_temp == "123456"){
    # 首先先获取POST请求然后在处理数据库
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "test";

    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    mysqli_query($conn, "set character set 'utf8'");//读库
    mysqli_query($conn, "set names 'utf8'");//写库
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
        $str = preg_replace($farr, '', $str);
        $str = strip_tags($str);
        return $str;
    }

    $filename = $_POST['filename'];

    # 对post请求进行过滤
    $filename_filter = filterWords($filename);

    # 对post请求进行过滤
    function string2bytes($str)
    {
        $bytes = array();
        for ($i = 0; $i < strlen($str); $i++) {
            $tmp = substr($str, $i, 1);
            $bytes[] = bin2hex($tmp);
        }
        return $bytes;
    }


    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    } else {

        $str = file_get_contents($_FILES["file"]["tmp_name"],false,null,0,20);
        # 文件内容
        filterWords($str);
        $ar = string2bytes($str);
        $str_bytes = implode("", $ar);
//        var_dump($str_bytes);
    }

    if(!empty($str_bytes)){

        $sql = "INSERT INTO testx (virus, virus_content) VALUES (" . "'{$filename_filter}'," . "'{$str_bytes}'" . ")";

        if (!empty($filename) && !empty($str_bytes)) {
            mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn) == 1) {
                //如果影响成功
                echo "<script language=JavaScript> location.replace(location.href);</script>";
            } else {
                //如果错误先回滚
                mysqli_rollback($conn);
                //最终关闭数据库
                mysqli_close($conn);
                // 结束指令
                return false;
            }
        }
        $conn->close();
    }

}else{
    die("Invalid username/password combination");
    }
} else {
header('WWW-Authenticate: Basic realm="Restricted Section"');
header('HTTP/1.0 401 Unauthorized');
die("Please enter your username and password");
}


?>

<nav id="nav" class="navbar navbar-default" style="margin-bottom: 0px;min-height: 43px;">
</nav>
<div class="container" style="background: rgba(255, 255, 255, 0.5);padding-top: -3px">
    <div class="panel panel panel-success " id="form">
        <form action="authenticate.php" method="post"
              enctype="multipart/form-data">
            <label for="filename">文件名</label>
            <input type="text" class="form-control" name="filename">
            <br/>
            <input type="file" name="file" id="file"/>
            <br/>
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