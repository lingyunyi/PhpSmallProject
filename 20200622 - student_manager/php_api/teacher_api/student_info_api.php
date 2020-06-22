<?php
require "../pubic_api/mysql_connect.php";
$grade = $_COOKIE["grade_b_id"];
if(empty($grade)){
    Header("Location:../../index.php");
}

$sql = "select * from student_manage_list where class_teacher_id = '{$grade}'";
$result = mysqli_query($conn, $sql);

$search = $_POST["search"];

$arr = array();
if ($search == "") {
    while ($row = mysqli_fetch_row($result)) {
        array_push($arr, "['$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]']");
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}

if ($search != "") {
    while ($row = mysqli_fetch_row($result)) {
        if ($row[1] == $search or $row[2] == $search or $row[3] == $search or $row[4] == $search or $row[5] == $search) {
            array_push($arr, "['$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]']");
        }
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}