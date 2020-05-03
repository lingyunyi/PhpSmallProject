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

echo $_GET["ckd_id"];
if(!empty($_GET["ckd_id"])){
    $select_sql = "DELETE FROM cdk WHERE cdk_id="."'{$_GET["ckd_id"]}'";
    var_dump($select_sql);
    // 使用 mysqli 函数的 query 提交到数据库服务器运行
    $result = mysqli_query($conn, $select_sql);
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
return "ok"
?>