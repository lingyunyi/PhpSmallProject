<?php
$servername = "103.66.217.35";
$username = "a0314161734";
$password = "31467349";
$dbname = "a0314161734";

// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($conn,"utf8");
mysqli_query($conn,"set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
// 检测连接
if ($conn->connect_error) {
    die("error " . $conn->connect_error);
}


var_dump($_GET["cdk_id"]);
var_dump(!empty($_GET["cdk_id"]));
if (!empty($_GET["cdk_id"])) {
    var_dump($_GET["cdk_id"]);
    $sql = "INSERT INTO cdk (cdk_id) VALUE (" . "'{$_GET["cdk_id"]}'". ")";
    echo $sql;
    $con = mysqli_query($conn, $sql);
    var_dump($con);
    if (mysqli_affected_rows($conn) == 1) {
        //如果影响成功
        var_dump("成功");
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
return "ok"
?>

