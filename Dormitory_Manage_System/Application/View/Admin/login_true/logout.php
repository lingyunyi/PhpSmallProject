<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19
 * Time: 18:48
 */
session_start();
?>
<?php
if(isset($_SESSION['users'])){
    // 如果有session
    unset($_SESSION['users']);
    header("location:skip.html");
    session_destroy();
    return true;
}else{
    // 如果没有session
    // header声明，返回
    header("location:skip.html");
    // 结束指令
    exit();
}
?>
