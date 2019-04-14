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
    $_GET['user_id'] = mysqli_real_escape_string($connect, $_GET['user_id']);
    $select_sql = 'select * from housing where identify =' . " '{$_GET['user_id']}'";
    $result = mysqli_query($connect,$select_sql);
    while ($row = mysqli_fetch_row($result)){
        if($row[5] == 0){
            $delete_sql = 'update housing set is_Del = 1 where identify = '."'{$_GET['user_id']}'";
            mysqli_query($connect,$delete_sql);
            var_dump(mysqli_affected_rows($connect));
            if(mysqli_affected_rows($connect) == 1){
                $echo_information = "退房成功......";
                header('location:../user_IO.php?information='."$echo_information");
                exit();
            }else{
                mysqli_rollback();
                $echo_information = "请重试......";
                header('location:../user_IO.php?information='."$echo_information");
                exit();
            }
        }
    }
    $echo_information = "请重试0.0......";
    header('location:../user_IO.php?information='."$echo_information");
}else{
    exit("请不要乱来......");
}
?>