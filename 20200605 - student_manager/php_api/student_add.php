<?php

require "../php_model/mysql_connect.php";


$student_id = $_POST["student_id"];
$student_name = $_POST["student_name"];
$student_sex = $_POST["student_sex"];
$student_class = $_POST["student_class"];
$student_phone = $_POST["student_phone"];


if($student_id != "" and $student_name != "" and $student_sex != "" and $student_class != "" and $student_phone != ""){
    $sql = "INSERT INTO student_info VALUES (" . "'',". "'{$student_id}',". "'{$student_name}',". "'{$student_sex}',". "'{$student_class}',". "'{$student_phone}'". ")";
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
