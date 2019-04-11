<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2
 * Time: 22:28
 */
?>
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
            <a class="navbar-brand" href="user_IOa.php">
                <h1 class="tm-site-title mb-0">用户信息系统</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link active" href="user_IO.php">
                            用户管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_info.php" >
                            信息管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_repair.php">
                            报修管理
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
<!--    -->
    <div class="container" style="text-align: center">
        <!-- row -->
        <div><br /><h2>用户入住:</h2><br /></div>
        <div class="user_in" >
            <form method="post" id="change_form" action="manage_sql/user_in_sql.php">
                <label>姓名：</label>
                <input type="text" name="nameX">
                <br />
                <label>房号：</label>
                <input type="text" name="houseIDX">
                <br />
                <label>租房/买房：</label>
                <select name="stateX">
                    <option value="0" selected>租房</option>
                    <option value="1">买房</option>
                </select>
                <br />
<?php
                $select_sql_housing = 'select identify from users';
                $result_housing = mysqli_sql($select_sql_housing);
                if($result_housing != false){
                    global $connect;
                    $result=mysqli_query($connect,$select_sql_housing);
                }
                ?>
                <label>用户：</label>
                <select name="user_id">
<?php
                while ($row=mysqli_fetch_row($result)){
                    echo "<option value=".$row[0].">"."$row[0]"."</option>";
                }
?>
                </select>
                <br />
                <label>电话：</label>
                <input type="text" name="iphoneX">
                <br />
                <label>地址：</label>
                <input type="text" name="addressX">
                <br />
                <button  id="submit_button" onclick="return Cmd('change_form');">提交</button>
                <br />
            </form>
        </div>
        <div>----------------------------------------------------------</div>
        <div class="user_out">
<?php
            if(!empty($_SESSION['users'])){
                //  session 不为空的情况下
                echo '<br>';
                echo '<h2>用户住房信息：</h2>';
                echo '<br>';
                $select_sql_housing = 'select * from housing';
                $result_housing = mysqli_sql($select_sql_housing);
                if($result_housing != false){
                    global $connect;
                    $result=mysqli_query($connect,$select_sql_housing);
?>
                    <div id="table_information">
                        <table border="1" style="margin: 0 auto;">
                            <thead>
                            <tr>
                                <th>用户ID</th>
                                <th>姓名</th>
                                <th>房号</th>
                                <th>状态</th>
                                <th>电话</th>
                                <th>入住时间</th>
                                <th>退房</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
                    while ($row=mysqli_fetch_row($result)){
                        if($row[5] != 1){?>
                            <tr>
                                <td><?php echo $row[6]?></td>
                                <td><?php echo $row[1]?></td>
                                <td><?php echo $row[2]?></td>
                                <td><?php if($row[3] == "0"){echo '租房';}else{echo '购房';}; ?></td>
                                <td><?php echo $row[4]?></td>
                                <td><?php echo $row[7]?></td>
                                <td><a href="manage_sql/user_out_sql.php?<?php echo $row[6];?>">退房</a></td>
                            </tr>
                        <?php }else{}
                    };?>
                            </tbody>
                        </table>
                    </div>
<?php
                }else{
                    //  if($result_housing != false)
                    //  这里代表没有数值
                    echo '未有人入住，还需要努力......';
                }
            }else{
                //  SESSION为空的情况下
                // if(!empty($_SESSION['users'])){
                header("location:skip.html");
                exit();
            }
?>
        </div>
    </div>
<!--    -->
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


