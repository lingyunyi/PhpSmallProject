<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 17:27
 */
//  定义一个连接数据库函数
function def_mysql_connect($sql){
    $host ="localhost";//服务器地址
    $root ="root";//用户名
    $password ="root";//密码
    $database ="dormitorysys";//数据库名
    $connect = mysqli_connect($host,$root,$password,$database);//连接数据库
    if(!$connect){
        die("数据库连接失败!".mysqli_error($connect));
    }else{
        echo"数据库连接成功";
    }
    mysqli_set_charset($connect,'utf8');
    $result = mysqli_query($connect,$sql);
    return $result;
}

$a = def_mysql_connect("select * from admins");

var_dump(mysqli_fetch_all($a));


















?>
