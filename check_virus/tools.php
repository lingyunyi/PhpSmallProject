<?php
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

function string2bytes($str)
{
    $bytes = array();
    for ($i = 0; $i < strlen($str); $i++) {
        $tmp = substr($str, $i, 1);
        $bytes[] = bin2hex($tmp);
    }
    return $bytes;
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


function check()
{
    # 查看是否为病毒，首先获取文件名，打开文件内容。
    # 循环获取数据库中的所有病毒的key and content
    # 循环匹配，如果成功返回true。
    # 匹配失败，返回false

    # 先提交的文件内容
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    } else {
        $filename = $_POST['filename'];
        # 过滤文件名
        filterWords($filename);
        $str = file_get_contents($_FILES["file"]["tmp_name"]);
        # 文件内容
        filterWords($str);
        $ar = string2bytes($str);
        $str_bytes = implode("", $ar);
    }

    $select_sql = "select * from testx";
    // 使用 mysqli 函数的 query 提交到数据库服务器运行
    global $conn;
    $result = mysqli_query($conn, $select_sql);
    // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
    while ($row = mysqli_fetch_row($result)) {
//        echo $str_bytes;
//        echo "<br>",$row[2],"<br>";
        if (stripos($str_bytes, $row[2]) !== false) {
            $strr = ["true", $row[1]];
            return $strr;
        }
    };
    $strr = ["false","null"];
    return $strr;
    # 循环获取数据库内容
}

$strr = ["wait","wait"];
$strr = check();


# 关闭数据库
$conn->close();
?>


