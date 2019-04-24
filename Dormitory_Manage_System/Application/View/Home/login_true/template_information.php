<?php
    include_once '../../Base/base.php';
    require 'function_sql.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户信息</title>
    <link rel="stylesheet" href="../../../../Pubilc/Style/Home/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../../../../Pubilc/Style/Home/templatemo-style.css">
</head>
<body id="reportsPage">
<div class="" id="home">
    <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
            <a class="navbar-brand" href="user_information.php">
                <h1 class="tm-site-title mb-0">用户信息系统</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link  active" href="user_information.php">
                            用户信息
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_change.php" >
                            更换信息
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_repair.php">
                            用户报修
                        </a>
                    </li>
                </ul>
                <!---->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link d-block" href="logout.php">
                            <?php echo $_SESSION['users']?>, <b>Logout</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="text-align: center;">
        <div class="centerBox">
            <?php
                if(!empty($_SESSION['users'])){
                        // 用户信息表
                        echo '<br>';
                        echo '<h2>用户个人信息：</h2>';
                        $select_sql = 'select * from usersdetail where identify ='." '{$_SESSION['users']}'";
                        $result = mysqli_sql($select_sql);
                        if($result != false){
                            echo "姓名：".$result[1];
                            echo '<br>';
                            echo "性别：".$result[2];
                            echo '<br>';
                            echo "地址：".$result[3];
                            echo '<br>';
                            echo "电话：".$result[4];
                            echo '<br>';
                        }else{
                            echo "<a href='template_change.php'>也许您还没有输入信息，请修改信息</a>";
                            echo "<br>";
                        }
                        echo "<b>---------------------------------------------------------------------------------</b>";
                        // 用户住房表
//                        -----------------------------------------------
                        echo '<br>';
                        echo '<h2>个人住房信息：</h2>';
                        $select_sql_two = 'select * from housing where identify ='." '{$_SESSION['users']}' and ID =  (select MAX(ID) from housing) ";
                        $result_two = mysqli_sql($select_sql_two);
                        if($result_two != false){
                            echo "姓名：".$result_two[1];
                            echo '<br>';
                            echo "房号：".$result_two[2];
                            echo '<br>';
                            echo "租房/买房：";if($result_two[3] == 0){echo "租房";}else{echo '业主';};
                            echo '<br>';
                            echo "电话：".$result_two[4];
                            echo '<br>';
                        }else{
                            echo "您还未入住本公寓";
                        }
                }else{
                    header("location:skip.html");
                    exit();
                }
            ?>
        </div>
    </div>

    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
            <p class="text-center text-white mb-0 px-4 small">
                Copyright &copy; <b>2018</b> Template Mo All rights reserved.
            </p>
        </div>
    </footer>
</div>
</body>
<script>
    function Cmd(id_name){
        var ipt = document.getElementById(id_name).getElementsByTagName("input"); //查找divbox这个div里的所有文本框
        for(var i = 0; i < ipt.length; i++){ //循环
            if(ipt[i].value.length == 0){ //如果其中一个文本框没有填写
                alert("所有文本框不能为空"); //弹出提示
                ipt[i].focus(); //定位到没有填写的文本框
                return false; //返回false
            }
        }
        return true; //都已经填写，返回true
    }
</script>
</html>
