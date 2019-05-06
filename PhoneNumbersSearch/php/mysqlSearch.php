<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 14:34
 */
$input=$_POST['searchInput'];
$sql = "select * from phonedata where Name='$input' or Phone='$input'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

?>
