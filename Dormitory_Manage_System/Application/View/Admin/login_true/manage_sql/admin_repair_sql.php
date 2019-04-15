<?php
/**
 * 首先，我们先接收从前端传入的数据。
 * 然后对数据进行转义
 * 然后对数据库进行执行操作
 * 然后判断影响
 * 如果影响等于一，回归
 * 小于一，回弹。
 */
session_start();
require '../function_sql.php';
if(!empty($_SESSION['users']) && !empty($_GET)) {
    global $connect;
    $_GET['table_id'] = mysqli_real_escape_string($connect, $_GET['table_id']);
    $select_sql = 'select * from repair where ID =' . "{$_GET['table_id']} ";
    if(mysqli_query($connect,$select_sql) == false){
        $echo_information = "没有数据.大哥......";
        header('location:../user_repair.php?information='."$echo_information");
        exit();
    }
    mysqli_close($connect);
    $host ="47.107.57.166";//服务器地址
    $root ="root";//用户名
    $password ="root";//密码
    $database ="dormitorysys";//数据库名
    $connect = mysqli_connect($host,$root,$password,$database);//连接数据库
    $up_sql = 'update repair set is_Del = 1 where ID = '."{$_GET['table_id']}";
    mysqli_query($connect,$up_sql);
    if(mysqli_affected_rows($connect) == 1){
        $echo_information = "报修ok......";
        header('location:../user_repair.php?information='."$echo_information");
        exit();
    }else{
        mysqli_rollback();
        $echo_information = "请重试......";
        header('location:../user_repair.php?information='."$echo_information");
        exit();
    }
    $echo_information = "请重试0.0......";
    header('location:../user_repair.php?information='."$echo_information");
}else{
    exit("请不要乱来......");
}
?>