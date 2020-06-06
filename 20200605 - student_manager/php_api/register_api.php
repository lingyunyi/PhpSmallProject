<?php

require "../php_model/mysql_connect.php";

$login_user = $_POST["login_user"];
$login_passwd = $_POST["login_passwd"];
if(!empty($login_user) and !empty($login_passwd)){
    $sql = "INSERT INTO login_users VALUES ('','{$login_user}','{$login_passwd}')";
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
        echo '{"status":"false"}';
        return false;
    }
}else{
    echo '{"status":"false"}';
}

?>