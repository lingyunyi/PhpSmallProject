<?php  session_start();
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_WARNING);
error_reporting(0);?>

<?php
if(isset($_SESSION['users'])){
    // 如果有session
    include 'template_repair.php';
}else{
    // 如果没有session
    // header声明，返回
    header("location:skip.html");
    // 结束指令
    exit();
}
?>