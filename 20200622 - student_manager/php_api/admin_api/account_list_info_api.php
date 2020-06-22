<?php
require "../pubic_api/mysql_connect.php";
$grade = $_COOKIE["grade_c_id"];
if(empty($grade)){
    Header("Location:../../index.php");
}

$sql = "select * from account_list WHERE account_type != 'C' ";
$result = mysqli_query($conn, $sql);

$search = $_POST["search"];

$arr = array();
if ($search == "") {
    while ($row = mysqli_fetch_row($result)) {
        if($row[4] == "A"){
            $type = "学生";
        }
        if($row[4] == "B"){
            $type = "老师";
        }
        array_push($arr, "['$row[0]','$row[1]','$row[2]','$row[3]','$type']");
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}

if ($search != "") {
    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] == $search or $row[1] == $search or $row[2] == $search or $row[3] == $search or $row[4] == $search) {
            if($row[4] == "A"){
                $type = "学生";
            }
            if($row[4] == "B"){
                $type = "老师";
            }
            array_push($arr, "['$row[0]','$row[1]','$row[2]','$row[3]','$type']");
        }
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}