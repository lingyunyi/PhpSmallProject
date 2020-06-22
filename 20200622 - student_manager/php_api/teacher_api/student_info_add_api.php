<?php

require "../pubic_api/mysql_connect.php";
$grade = $_COOKIE["grade_b_id"];
if(empty($grade)){
    Header("Location:../../index.php");
}


$student_id = $_POST["student_id"];
$student_name = $_POST["student_name"];
$student_class = $_POST["student_class"];
$student_class_num = $_POST["student_class_num"];

$sql = "select login_name from account_list  where login_account = '{$grade}' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result);

$class_teacher_id = $grade;


if($row != null){
    $class_teacher_name = $row[0][0];
    $time = date('Y-m-d H:i:s',time());
    if (!empty($student_id) and !empty($student_name) and !empty($student_class) and !empty($student_class_num)) {
        $sql = "INSERT INTO student_manage_list VALUES ('','{$student_id}','{$student_name}','{$student_class}','{$student_class_num}','{$class_teacher_name}','{$class_teacher_id}','{$time}')";
        $con = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) == 1) {
            //如果影响成功
            echo '{"status":"true"}';
            return true;
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
        return false;
    }
}

echo '{"status":"false"}';



?>