<?php

require "../pubic_api/mysql_connect.php";

$student_class = $_POST["student_class"];
$student_class_num = $_POST["student_class_num"];
$nid = $_POST["nid"];



if (!empty($student_class) and !empty($nid) and !empty($student_class_num)) {
    $sql = "UPDATE student_manage_list SET student_class = '{$student_class}',student_class_num = '{$student_class_num}' WHERE id = '{$nid}' ";
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