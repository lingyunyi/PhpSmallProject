<?php

require "../pubic_api/mysql_connect.php";

$login_user = $_POST["login_user"];
$login_name = $_POST["login_name"];
$login_passwd = $_POST["login_passwd"];
$login_type = $_POST["login_type"];


if(!empty($login_user) and !empty($login_passwd) and !empty($login_name) and !empty($login_type)){
    $sql = "select * from account_list where login_account = '{$login_user}' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row != null){
        echo '{"status":"false"}';
        return false;
    }
    $sql = "INSERT INTO account_list VALUES ('','{$login_user}','{$login_name}','{$login_passwd}','{$login_type}',0)";
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