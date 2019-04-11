<?php
// 导入function sql。php
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL ^ E_WARNING);
//error_reporting(0);
require '../function_sql.php';
/**
 * 1)简单理一下思路，首先我们链接数据库
 * 2)然后获取从前页传输过来的POST请求
 * 3)然后通过转义的方式，转义数据
 * 4)之后再插入数据库
 * 5)插入数据库之前，先判断是否为逻辑上的已删除
 * 6)判断是否存在
 * 7)如果有的话，那么返回用户已入住的信息
 */
if(!empty($_SESSION['users'] && !empty($_POST))) {
    //  判断数据库中是否有数据，如果有就更新，没有就添加
    $select_sql = 'select * from housing where identify =' . " '{$_POST['user_id']}'";
    $result = mysqli_sql($select_sql);
    if ($result != false) {
        while ($row=mysqli_fetch_row($result)){
            echo $row[5];
            var_dump($row[5]);
            if($row[5] == 0){
                // 证明已经存在住房记录，不可以插入。
                $echo_information = "存在重复的信息，用户未退房......";
                header('location:../user_IO.php?information='."$echo_information");
                exit();
            }
        }
        exit();
        // 到这里代表没有，已存在的住房记录。
        // 防止SQL注入，进行数据转义
        $_POST["nameX"] = mysqli_real_escape_string($connect, $_POST["nameX"]);
        $_POST["houseIDX"] = mysqli_real_escape_string($connect, $_POST["houseIDX"]);
        $_POST["stateX"] = mysqli_real_escape_string($connect, $_POST["stateX"]);
        $_POST["stateX"] = (int)$_POST["stateX"];
        $_POST["iphoneX"] = mysqli_real_escape_string($connect, $_POST["iphoneX"]);
        $_POST["addressX"] = mysqli_real_escape_string($connect, $_POST["addressX"]);
        $_POST["user_id"] = mysqli_real_escape_string($connect, $_POST["user_id"]);
        // 写一个插入数据库的sql语句
        $insert =  "insert into housing(nameX,houseIDX,stateX,iphoneX,is_Del,identify,timenow) values (" . "'{$_POST["nameX"]}',"."'{$_POST["houseIDX"]}',"."'{$_POST["stateX"]}',"."'{$_POST["iphoneX"]}',"."0,"."'{$_POST['user_id']}',now()".")";
        mysqli_sql($insert);
        if(mysqli_affected_rows($connect) == 1){
            mysqli_free_result($result);
            $echo_information = "添加成功......";
            header('location:../user_IO.php?information='."$echo_information");
        }else{
            mysqli_rollback();
            $echo_information = "请重试......";
            header('location:../user_IO.php?information='."$echo_information");
        }
    }else{
        // 到这里代表没有，已存在的住房记录。
        // 防止SQL注入，进行数据转义
        $_POST["nameX"] = mysqli_real_escape_string($connect, $_POST["nameX"]);
        $_POST["houseIDX"] = mysqli_real_escape_string($connect, $_POST["houseIDX"]);
        $_POST["stateX"] = mysqli_real_escape_string($connect, $_POST["stateX"]);
        $_POST["stateX"] = (int)$_POST["stateX"];
        $_POST["iphoneX"] = mysqli_real_escape_string($connect, $_POST["iphoneX"]);
        $_POST["addressX"] = mysqli_real_escape_string($connect, $_POST["addressX"]);
        $_POST["user_id"] = mysqli_real_escape_string($connect, $_POST["user_id"]);
        // 写一个插入数据库的sql语句
        $insert =  "insert into housing(nameX,houseIDX,stateX,iphoneX,is_Del,identify,timenow) values (" . "'{$_POST["nameX"]}',"."'{$_POST["houseIDX"]}',"."'{$_POST["stateX"]}',"."'{$_POST["iphoneX"]}',"."0,"."'{$_POST['user_id']}',now()".")";
        mysqli_sql($insert);
        if(mysqli_affected_rows($connect) == 1){
            mysqli_free_result($result);
            $echo_information = "添加成功0.0......";
            header('location:../user_IO.php?information='."$echo_information");
        }else{
            mysqli_rollback();
            $echo_information = "请重试......";
            header('location:../user_IO.php?information='."$echo_information");
        }
    }
}else{
    exit("请不要乱来......");
}
?>