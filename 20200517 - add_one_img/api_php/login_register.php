<?php

require_once "../db_php.php";
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




$typex = $_POST["type"];
if ($typex == "login") {
    $username = $_POST['username'];
    $userpasswd = $_POST['userpasswd'];
    filterWords($username);
    filterWords($userpasswd);
    $hash_passwd = md5($userpasswd);
    $select_sql = "select * from users";
    // 使用 mysqli 函数的 query 提交到数据库服务器运行
    global $conn;
    $result = mysqli_query($conn, $select_sql);
    // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
    $sttr = '{"status":"false"}';
    while ($row = mysqli_fetch_row($result)) {
        if ($username == $row[1] && $hash_passwd == $row[2]) {
            $sttr = '{"status":"true","username":"'.$username.'"}';
            echo $sttr;
            return true;
        }
    };
    echo $sttr;
    return false;

}
if ($typex == "register") {
    $username = $_POST['username'];
    $userpasswd = $_POST['userpasswd'];
    filterWords($username);
    filterWords($userpasswd);
    $hash_passwd = md5($userpasswd);

    $sql = "INSERT INTO users (username, userpasswd) VALUES (" . "'{$username}'," . "'{$hash_passwd}'" . ")";
    $sttr = '{"status":"false"}';
    if (!empty($username) && !empty($userpasswd)) {
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) == 1) {
            //如果影响成功
            $sttr = '{"status":"true"}';
            echo $sttr;
            return true;
        } else {
            //如果错误先回滚
            mysqli_rollback($conn);
            //最终关闭数据库
            mysqli_close($conn);
            // 结束指令
        }
    }
    echo $sttr;
    return false;
}
$conn->close();
?>