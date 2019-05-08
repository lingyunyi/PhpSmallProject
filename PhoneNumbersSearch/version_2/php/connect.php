<?php
    header("Content-Type: text/html; charset=utf-8");
	$connect = mysqli_connect("localhost","root","root","phone");
	mysqli_set_charset($connect,'utf8');
	if (!$connect){
	    die("数据库连接错误".mysqli_connect_error());
    }
?>