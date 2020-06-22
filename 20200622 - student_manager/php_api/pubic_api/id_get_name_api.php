<?php

require "../pubic_api/mysql_connect.php";

$login_id = $_POST["login_id"];

if (!empty($login_id)) {
    $sql = "select login_name from account_list where login_account = '{$login_id}' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row != null){
        echo '{"status":"true","id_name":"'.$row[0][0].'"}';
    }else{
        echo '{"status":"false2","sql":"'.$sql.'"}';
    }

} else {
    echo '{"status":"false"}';
}