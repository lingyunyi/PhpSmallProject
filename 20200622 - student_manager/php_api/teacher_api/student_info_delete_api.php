<?php
require "../pubic_api/mysql_connect.php";
$grade = $_COOKIE["grade_b_id"];
if(empty($grade)){
    Header("Location:../../index.php");
}


$nid = $_POST["nid"];

if (!empty($nid)) {
    $sql = "DELETE FROM student_manage_list where id = '{$nid}' ";
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