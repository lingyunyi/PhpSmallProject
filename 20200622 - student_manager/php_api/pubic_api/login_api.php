<?php

require "../pubic_api/mysql_connect.php";

$login_user = $_POST["login_user"];
$login_name = $_POST["login_name"];
$login_passwd = $_POST["login_passwd"];
$login_type = $_POST["login_type"];


if(!empty($login_user) and !empty($login_passwd) and !empty($login_name) and !empty($login_type)){

    $sql = "select * from account_list where login_account = '{$login_user}' and login_passwd = '{$login_passwd}' and login_name = '{$login_name}' and account_type = '{$login_type}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row == null){
        echo '{"status":"false"}';
    }else{
        echo '{"status":"true","grade":"'.$login_type.'"}';
    }

}else{
    echo '{"status":"false"}';
}

?>