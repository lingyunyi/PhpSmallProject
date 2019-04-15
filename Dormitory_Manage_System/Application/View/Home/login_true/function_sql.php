<?php
/**
 *  封装一个sql操作的函数
 *  进行功能封装
 */

include_once '../../Base/base.php';
?>
<?php
    $host ="47.107.57.166";//服务器地址
    $root ="root";//用户名
    $password ="root";//密码
    $database ="dormitorysys";//数据库名
    $connect = mysqli_connect($host,$root,$password,$database);//连接数据库
    mysqli_set_charset($connect,"utf8");//设置字符集
    if(!$connect){
        // 如果连接不成功直接返回原有界面
        printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
        // header声明，返回
        header("location:index.html");
        // 结束指令
        exit();
    }
    function mysqli_sql($sql){
        global $connect;
        if ($result=mysqli_query($connect,$sql)) {
            $row=mysqli_fetch_row($result);
            return $row;
        }else{
            return false;
        }
    }
?>
