<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19
 * Time: 23:14
 */
    include_once '../../Base/base.php';
    require 'function_sql.php';
?>
<?php
$echo_information = "等待提交......";
if(!empty($_SESSION['users'])){
    //  判断数据库中是否有数据，如果有就更新，没有就添加
    $select_sql = 'select * from usersdetail where identify ='." '{$_SESSION['users']}'";
    $result = mysqli_sql($select_sql);
    if($result != false){
        $updata = "update usersdetail set nameX = "."'{$_POST['nameX']}', "."addressX ="."'{$_POST['addressX']}', "."sexX ="."'{$_POST['sexX']}', "."iphoneX ="."'{$_POST['iphoneX']}'"." where identify ="."'{$_SESSION['users']}'";
        global $echo_information;
        mysqli_sql($updata);
        if(mysqli_affected_rows($connect) == 1){
            $echo_information = "更新成功......";
            header('location:user_change.php?information='."$echo_information");
        }else{
            mysqli_rollback();
            $echo_information = "请重试......";
            header('location:user_change.php?information='."$echo_information");
        }
    }else{
        //否则插入
        $insert =  "insert into usersdetail(nameX,sexX,addressX,iphoneX,identify) values (" . "'{$_POST["nameX"]}',"."'{$_POST["addressX"]}',"."'{$_POST["sexX"]}',"."'{$_POST["iphoneX"]}', "."'{$_SESSION['users']}' ".")";
        global $echo_information;
        mysqli_sql($insert);
        if(mysqli_affected_rows($connect) == 1){
            $echo_information = "添加成功......";
            header('location:user_change.php?information='."$echo_information");
        }else{
            mysqli_rollback();
            $echo_information = "请重试......";
            header('location:user_change.php?information='."$echo_information");
        }
    }
}else {
    header("location:skip.html");
    exit();
}
?>