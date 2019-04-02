<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/8
 * Time: 23:22
 */
?>
<?php
include_once '../../Base/base.php';
?>
<?php
if(isset($_SESSION['users'])){
    // 如果有session
    include 'template_admin_info.php';
}else{
    // 如果没有session
    // header声明，返回
    header("location:skip.html");
    // 结束指令
    exit();
}
?>
