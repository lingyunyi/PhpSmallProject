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
    <title>用户报修</title>
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
                        <a class="nav-link" href="user_change.php" >
                            更换信息
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="user_repair.php">
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
        <!-- row -->
        <div class="centerBox">
<?php
            if(!empty($_SESSION['users'])){
                // 用户信息表
                echo '<br>';
                echo '<h2>用户住房信息：</h2>';
                // 这里查询的是用户租房表
                $select_sql_housing = 'select * from housing where identify ='." '{$_SESSION['users']}'";
                $result_housing = mysqli_sql($select_sql_housing);
                if($result_housing != false && $result_housing[5] != 1){
                    echo "姓名：".$result_housing[1];
                    echo '<br>';
                    echo "房号：".$result_housing[2];
                    echo '<br>';
                    echo "租房/买房："; if($result_housing[3] == 0){echo "租房";}else{echo "业主";};
                    echo '<br>';
                    echo "电话：".$result_housing[4];
                    echo '<br>';
                    // 如果有就代表用户已经租房或者买房了
                    echo '<b>-------------------------------------------------------------------------------------</b>';
                    echo '<br>';
                    echo '<h2>用户报修：</h2>';
?>
                    <form method="post" id="repair_form" action="user_repair_sql.php">
                    <label>姓名：</label>
                    <input type="text" name="nameX" value="<?php echo $result_housing[1]; ?>" readonly="readonly">
                    <br />
                    <label>房号：</label>
                    <input type="text" name="houseIDX" value="<?php echo $result_housing[2];?>" readonly="readonly">
                    <br />
                    <label>电话：</label>
                    <input type="text" name="iphoneX" value="<?php echo $result_housing[4]; ?>" readonly="readonly">
                    <br />
                    <label>报修问题：</label>
                    <input type="text" name="repairX">
                    <br />
                    <button  id="submit_button" onclick="return Cmd('repair_form');">提交</button>
                    <br/>
<?php
                    echo '<b>-------------------------------------------------------------------------------------</b>';
                    echo '<br>';
                    echo '<h2>报修状态：</h2>';
                    $select_sql_repair = 'select * from repair where identify ='." '{$_SESSION['users']}' ORDER BY id DESC LIMIT 8";
                    global $connect;
                    if($result=mysqli_query($connect,$select_sql_repair)){
                        //这里代表有数据
?>
                        <div id="table_information">
                            <table border="1" style="margin: 0 auto;">
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>房号</th>
                                    <th>电话</th>
                                    <th>报修问题</th>
                                    <th>维修状态</th>
                                    <th>报修时间</th>
                                </tr>
                                </thead>
                                <tbody>
<?php
                        while ($row=mysqli_fetch_row($result)){?>
                            <tr>
                                <td><?php echo $row[1]?></td>
                                <td><?php echo $row[2]?></td>
                                <td><?php echo $row[3]?></td>
                                <td><?php echo $row[4]?></td>
                                <td><?php if($row[5] == 0){echo '待维修';}else{echo '已维修';}; ?></td>
                                <td><?php echo $row[8]?></td>
                            </tr>
                            <?php
                        };
                        ?>
                                </tbody>
                            </table>
                        </div>
<?php
                    }else{
                        //if($result_repair != false)
                        //这里代表没有数据
                        echo "您还从未报修过哦~";
                    }

                }else{
                    //if($result_housing != false && $result_housing[5] != 1)
                    echo "您还未入住本公寓";
                }
            }else{
                //if(!empty($_SESSION['users']))
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
