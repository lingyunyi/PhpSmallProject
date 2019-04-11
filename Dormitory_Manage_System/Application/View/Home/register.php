<?php
/*
 步骤：
    首先，判断传过来的POST请求中的值;
    如果值不为空：
        连接数据库
            判断传过来的值中，是否有异常，或者违规行为：
                如果没有：
                    插入数据库，并查询是否插入成功：
                        如果插入成功：
                            skip 跳转到 注册成功界面，并回跳到，index.html界面
                        如果没有插入成功：
                            skip 跳转到 注册失败，请重试，并回跳到，index.html界面
                如果有异常行为：
                    skip 跳转到 注册失败，请重试，并回跳到，index.html界面
    如果为空：
        skip 跳转到 登入失败，重新登入的界面，也就是 login.html界面。
        在跳转之前得输出，echo “登入失败、账号密码不正确的界面”

 */
    include_once '../Base/base.php';
?>

<?php
// 在这里判断是否存在SESSION 如果存在，就不给注册。
if(isset($_SESSION["users"])){
    // header声明，返回
    header("location:index.html?error=IP注册过一次");
    // 结束指令
    exit();
}
?>
<?php
// 首先判断从POST请求中的值
if(!empty($_POST["account"] || !empty($_POST["password"]))){
    // 如果值不为空，就得判断是否存在，数据库中，account账号
    $host ="localhost";//服务器地址
    $root ="root";//用户名
    $password ="root";//密码
    $database ="dormitorysys";//数据库名
    $connect = mysqli_connect($host,$root,$password,$database);//连接数据库
    mysqli_set_charset($connect,"utf8");
    $select_sql = "select * from users where identify = "."'{$_POST["account"]}'";
    // 数据库是否连接成功
    if(!$connect){
        // 如果连接不成功直接返回原有界面
        printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
        // header声明，返回
        header("location:index.html?error=数据库连接失败");
        // 结束指令
        exit();
    }
    // 接下来判断账号是否存在，如果存在就不给创建
    if ($result=mysqli_query($connect,$select_sql)){
        $row=mysqli_fetch_row($result);
        //判断是否存在结果
        if($row == null){
            //如果等于NULL就说明没有账号
            //这时候我们就根据他给的值，进行注册
            $_POST["account"]=mysqli_real_escape_string($connect,$_POST["account"]);
            $_POST["password"]=mysqli_real_escape_string($connect,$_POST["password"]);
            $register_sql = "insert into users(identify,passwd) values (" . "'{$_POST["account"]}',"."'{$_POST["password"]}'".")";
            mysqli_query($connect,$register_sql);
            if(mysqli_affected_rows($connect) == 1){
                //如果影响成功
                $_SESSION["users"] = $_POST["account"];
                header("location:./login_true/user_information.php");
                return true;
            }else{
                //如果错误先回滚
                mysqli_rollback($connect);
                //最终关闭数据库
                mysqli_close($connect);
                header("location:index.html?error=sql没有执行成功");
                // 结束指令
                return false;
            }
        }else{
            //如果不是NULL也就是说账号存在，咋们就不给他注册
            header("location:index.html?errot=账号已经存在");
            // 结束指令
            return false;
        }
    }else{
        //这里代表sql语句执行失败
        header("location:index.html?error=sql语句有误");
        // 结束指令
        exit();
    }
}else{
    // 代表POST请求里面有空值，所以这里就是被人假传POST请求咯
    header("location:index.html?error=请登入");
    exit();
}



?>

