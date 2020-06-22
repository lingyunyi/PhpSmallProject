<?php

require "../pubic_api/mysql_connect.php";

$login_name = $_POST["login_name"];
$login_re_passwd = $_POST["login_re_passwd"];
$nid = $_POST["nid"];
if (!empty($login_name) and !empty($nid) and !empty($login_re_passwd)) {
    $sql = "UPDATE account_list SET login_name = '{$login_name}',login_passwd = '{$login_re_passwd}' WHERE id = '{$nid}' ";
    $con = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) == 1) {
        //如果影响成功
        echo '{"status":"true"}';
    } else {
        //如果错误先回滚
        mysqli_rollback($conn);
        //最终关闭数据库
        mysqli_close($conn);
        // 结束指令
        echo '{"status":"false","false":"2"}';
        return false;
    }
} else {
    echo '{"status":"false"}';
}

?>