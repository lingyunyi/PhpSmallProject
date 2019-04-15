<?php
/*
 步骤：
    首先，判断传过来的POST请求中的值;
    如果值不为空：
        连接数据库
            判断，IDname 是否存在：
                如果存在，判断POST请求中 password的密码是否等于 IDname 的 password， 简单来说第二步就是判断，输入的密码是否正确
                    也就是 IDname = IDname Password = Password ？
                        如果，匹配成功：
                            skip 跳转到 登入成功后的界面 ————/login.true
                        如果，匹配不成功：
                            skip 跳转到 登入失败，重新登入的界面，也就是 login.html界面。
                            在跳转之前得输出，echo “登入失败、账号密码不正确的界面”
            如果不存在：
                skip 跳转到 登入失败，重新登入的界面，也就是 index.html界面。
                在跳转之前得输出，echo “登入失败、账号密码不正确的界面”
    如果为空：
        skip 跳转到 登入失败，重新登入的界面，也就是 index.html界面。
        在跳转之前得输出，echo “登入失败、账号密码不正确的界面”

 */
    include_once '../Base/base.php';
?>

<?php
// 首先判断从POST请求中的值
if(!empty($_POST["account"]) || !empty($_POST["password"])){
    // 如果值不为空，就得判断是否存在，数据库中，account账号
    $host ="47.107.57.166";//服务器地址
    $root ="root";//用户名
    $password ="root";//密码
    $database ="dormitorysys";//数据库名
    $connect = mysqli_connect($host,$root,$password,$database);//连接数据库
    mysqli_set_charset($connect,"utf8");
    $select_sql = "select * from admins where identify = "."'{$_POST["account"]}'";
    // 数据库是否连接成功
    if(!$connect){
        // 如果连接不成功直接返回原有界面
        printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
        // header声明，返回
        header("location:index.html");
        // 结束指令
        exit();
    }
    // 接下来判断账号是否存在
    if ($result=mysqli_query($connect,$select_sql)) {
        $row=mysqli_fetch_row($result);
        // 判断结果是否不等于 NULL
        if(!$row == null){
            // 如果不是NULL，也就是说，有账号，那么接下来就得判断密码是否相等
            $match_sql = "select * from admins where identify = "."'{$_POST["account"]}' and passwd = "."'{$_POST['password']}'";
            if($result=mysqli_query($connect,$match_sql)) {
                $row = mysqli_fetch_row($result);
                // 接下来，判断，匹配密码语句是否陈宫
                if(!$row == null){
                    // 这里就是代表账号密码匹配成功
                    // 设置session，并设置值
                    $_SESSION["users"] = $_POST["account"];
                    header('location:./login_true/user_IO.php');
                    return true;
                }else{
                    // 如果到这里就代表，匹配密码语句执行不成功
                    header('location:index.html?errot=密码不正确');
                    return true;
                }
            }else{
                // 如果到这里就代表，执行sql语句有错
                // 重新来过，没有提示
                header("location:index.html?error=sql语句有错");
                return false;
            }
        }else{
            // 如果等于NULL
            header("location:index.html?error=没有账号");
            // 结束指令
            exit();
        }
        mysqli_free_result($result);
    }else{
        // header声明，返回
        header("location:index.html?error=sql有误");
        // 结束指令
        exit();
    }
}else{
    // 代表POST请求里面有空值，所以这里就是被人假传POST请求咯
    header("location:index.html?error=请登入");
    exit();
}




?>
