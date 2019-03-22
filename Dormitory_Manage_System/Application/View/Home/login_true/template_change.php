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
    <title>更换信息</title>
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
                        <a class="nav-link" href="user_information.php">
                            用户信息
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_change.php" >
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
    <div class="container">
        <!-- row -->
        <div class="centerBox" style="text-align: center;">

            <br />
<!--            信息更换表单-->
            <h2>更换个人信息：</h2>
            <br/>
            <form method="post" id="change_form" action="user_change_sql.php">
                <label>姓名：</label>
                <input type="text" name="nameX">
                <br />
                <label>性别：</label>
                <select name="sexX">
                    <option value="男" selected>男</option>
                    <option value="女">女</option>
                </select>
                <br />
                <label>地址：</label>
                <input type="text" name="addressX">
                <br />
                <label>电话：</label>
                <input type="text" name="iphoneX">
                <br />
                <button  id="submit_button" onclick="return Cmd('change_form');">提交</button>
                <br />
                <b><?php echo $_GET['information'];?></b>
            </form>
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
<script language="JavaScript">
    function Cmd(id_name){
        var ipt = document.getElementById(id_name).getElementsByTagName("input"); //查找divbox这个div里的所有文本框
        for(var i = 0; i < ipt.length; i++){ //循环
            if(ipt[i].value.length == 0){ //如果其中一个文本框没有填写
                alert("所有文本框不能为空"); //弹出提示
                ipt[i].focus(); //定位到没有填写的文本框
                return false; //返回false
            }
        }
        return  true//都已经填写，返回truereturn true; //都已经填写，返回true
    }
</script>
</html>

