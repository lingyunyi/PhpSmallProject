<?php

require "../pubic_api/mysql_connect.php";

$login_account = $_POST["login_account"];
$login_passwd = $_POST["login_passwd"];
$login_re_passwd = $_POST["login_re_passwd"];
$account_type = $_POST["account_type"];

if(!empty($login_account) and !empty($login_passwd) and !empty($login_re_passwd)){
    $sql = "select * from account_list where login_account = '{$login_account}' and login_passwd  = '{$login_passwd}' and account_type  = '{$account_type}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row == null){
        echo '{"status":"false","false":"1"}';
    }else{
        $sql = "UPDATE account_list SET login_passwd = '{$login_re_passwd}' WHERE login_account = '{$login_account}' and account_type  = '{$account_type}' ";
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
    }

}else{
    echo '{"status":"false"}';
}

?>