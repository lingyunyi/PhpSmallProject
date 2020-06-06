<?php

require "../php_model/mysql_connect.php";



$sql = "select * from student_info";
$result = mysqli_query($conn, $sql);

$search = $_POST["search"];

$arr = array();
if ($search == ""){
    while ($row = mysqli_fetch_row($result)) {
        array_push($arr,"['$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]']");
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}

if ($search != ""){
    while ($row = mysqli_fetch_row($result)) {
        if ($row[1] == $search or $row[2] == $search or $row[3] == $search or $row[4] == $search or $row[5] == $search ){
            array_push($arr,"['$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]']");
        }
    };
    $json_arr = json_encode($arr);
    echo $json_arr;
}



