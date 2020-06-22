<?php
require_once '../../php_api\pubic_api\mysql_connect.php';
error_reporting(0);
$cookie_name = $_GET["cookie_name"];
if ($cookie_name != null){
    setcookie('grade_a_id',$cookie_name,time()+36000, "/");
}
$grade = $_COOKIE["grade_a_id"];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人中心 - 学长登入中心</title>

    <link href="../../html_static/pubuic_static/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../html_static/pubuic_static/css/datepicker3.css" rel="stylesheet">
    <link href="../../html_static/pubuic_static/css/styles.css" rel="stylesheet">


</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>学生信息</span>管理</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                class="glyphicon glyphicon-user"><?php echo $grade ?></span><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../../php_api\pubic_api\logout_api.php"><span
                                        class="glyphicon glyphicon-log-out"></span>登出</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="student_info.php"><span class="glyphicon glyphicon-tree-deciduous"></span>我的成绩</a>
        </li>
        <li><a href="student_repasswd.php"><span class="glyphicon glyphicon-tree-deciduous"></span>修改密码</a></li>
        <li role="presentation" class="divider"></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">我的成绩</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">我的成绩</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="查询系统：任意字段查询" id="search"
                               oninput="AjaxSend();">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="text-align: center">
                            <thead>
                            <tr>
                                <th style="text-align: center">序号</th>
                                <th style="text-align: center">学生ID</th>
                                <th style="text-align: center">姓名</th>
                                <th style="text-align: center">课程</th>
                                <th style="text-align: center">分数</th>
                                <th style="text-align: center">教师</th>
                                <th style="text-align: center">教师ID</th>
                                <th style="text-align: center">录入时间</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->

<script src="../../html_static/pubuic_static/js/jquery-1.11.1.min.js"></script>
<script src="../../html_static/pubuic_static/js/bootstrap.min.js"></script>
<script src="../../html_static/pubuic_static/js/bootstrap-datepicker.js"></script>
<script>

    window.onload = function () {
        AjaxSend();
    }


    function AjaxSend() {
        $.ajax({
            url: '../../php_api/student_api/student_info_api.php',
            type: "POST",
            data: {
                "search": $("#search").val(),
            },
            // 设置超时的时间XXs
            timeout: 30000,
            success: function (recv) {
                //当服务端处理完成后，返回数据时，该函数自动调用
                // data代表服务器给我们返回的值
                // 可以使用 JavaScript进行html的内容修改展示内容，或者刷新界面
                console.log(recv)
                // 登入成功
                recv = JSON.parse(recv)
                $("#tbody").empty()
                if (recv != "") {
                    for (i = 0, len = recv.length; i < len; i++) {
                        console.log(i, ' => ', recv[i])
                        var data = eval(recv[i])
                        str = '<tr>' +
                            '<td>' +
                            data[0] +
                            '</td>' +
                            '<td>' +
                            data[1] +
                            '</td>' +
                            '<td>' +
                            data[2] +
                            '</td>' +
                            '<td>' +
                            data[3] +
                            '</td>' +
                            '<td>' +
                            data[4] +
                            '</td>' +
                            '<td>' +
                            data[5] +
                            '</td>' +
                            '<td>' +
                            data[6] +
                            '</td><td>' +
                            data[7] +
                            '</td></tr>';
                        console.log(str);
                        $("#tbody").append(str)
                    }
                };
            }
        })
    }
</script>
</body>

</html>
