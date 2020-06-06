<?php

require "../php_model/mysql_connect.php";

$login_user = $_POST["login_user"];
$login_passwd = $_POST["login_passwd"];
if(!empty($login_user) and !empty($login_passwd)){
    $sql = "select * from login_users where username = '{$login_user}' and passwd = '{$login_passwd}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row == null){
        echo '{"status":"false"}';
    }else{
        echo '{"status":"true"}';
    }

}else{
    echo '{"status":"false"}';
}

?>