<?php
    include_once '../../Base/base.php';
    require 'function_sql.php';
?>
<?php
/**
 * 首先先接受从用户报修界面传过来的post的值
 * 然后根据值进行插入
 */

if(!empty($_SESSION['users'] && !empty($_POST))){
    // 进行mysqli的转义
    $_POST["nameX"]=mysqli_real_escape_string($connect,$_POST["nameX"]);
    $_POST["houseIDX"]=mysqli_real_escape_string($connect,$_POST["houseIDX"]);
    $_POST["iphoneX"]=mysqli_real_escape_string($connect,$_POST["iphoneX"]);
    $_POST["repairX"]=mysqli_real_escape_string($connect,$_POST["repairX"]);
    $_POST["users"]=mysqli_real_escape_string($connect,$_POST["users"]);
    $insert =  "insert into repair(nameX,houseIDX,iphoneX,repairX,identify,nowtime) values (" . "'{$_POST["nameX"]}',"."'{$_POST["houseIDX"]}',"."'{$_POST["iphoneX"]}',"."'{$_POST["repairX"]}', "."'{$_SESSION['users']}', now()".")";
    $result = mysqli_sql($insert);
    if(mysqli_affected_rows($connect) == 1){
        $echo_information = "添加成功......";
        header('location:user_repair.php?information='."$echo_information");
    }else{
        $echo_information = "请重试......";
        mysqli_rollback();
        //释放一次结果集
        header('location:user_repair.php?information='."$echo_information");
    }
}else {
    header("location:skip.html");
    exit();
}
?>

