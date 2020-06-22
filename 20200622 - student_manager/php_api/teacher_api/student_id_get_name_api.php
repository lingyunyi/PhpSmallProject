<?php
require "../pubic_api/mysql_connect.php";
$grade = $_COOKIE["grade_b_id"];
if(empty($grade)){
    Header("Location:../../index.php");
}

$student_id = $_POST["student_id"];

if (!empty($student_id)) {
    $sql = "select login_name from account_list where login_account = '{$student_id}' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result);
    if($row != null){
        echo '{"status":"true","student_name":"'.$row[0][0].'"}';
    }else{
        echo '{"status":"false2","sql":"'.$sql.'"}';
    }

} else {
    echo '{"status":"false"}';
}