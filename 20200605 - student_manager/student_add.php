<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人中心 - 用户管理系统</title>

    <link href="static/Users/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/Users/css/datepicker3.css" rel="stylesheet">
    <link href="static/Users/css/styles.css" rel="stylesheet">


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
                            class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/public_api/logout/"><span class="glyphicon glyphicon-log-out"></span>登出</a></li>
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
        <li><a href="student_info.php"><span class="glyphicon glyphicon-tree-deciduous"></span>学生信息管理</a></li>
        <li class="active"><a href="student_add.php"><span class="glyphicon glyphicon-tree-deciduous"></span>新增学生信息</a></li>
        <li role="presentation" class="divider"></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">新增学生信息</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新增学生信息</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">新增学生信息</div>
                <div class="panel-body">
                    <section>
                        <div class="form-group">
                            <label for="student_id">学号</label>
                            <input type="text" class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group">
                            <label for="student_name">姓名</label>
                            <input type="text" class="form-control" id="student_name" name="student_name">
                        </div>
                        <div class="form-group">
                            <label for="student_sex">性别</label>
                            <input type="text" class="form-control" id="student_sex" name="student_sex">
                        </div>
                        <div class="form-group">
                            <label for="student_class">班级</label>
                            <input type="text" class="form-control" id="student_class" name="student_class">
                        </div>
                        <div class="form-group">
                            <label for="student_phone">电话</label>
                            <input type="text" class="form-control" id="student_phone" name="student_phone">
                        </div>
                        <button type="submit" class="btn btn-default" onclick="return AjaxSend();">新增</button>
                    </section>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->

<script src="static/Users/js/jquery-1.11.1.min.js"></script>
<script src="static/Users/js/bootstrap.min.js"></script>
<script src="static/Users/js/bootstrap-datepicker.js"></script>
<script>


    function AjaxSend() {
        $.ajax({
            url: 'php_api/student_add.php',
            type: "POST",
            data: {
                "student_id": $("#student_id").val(),
                "student_name": $("#student_name").val(),
                "student_sex": $("#student_sex").val(),
                "student_class": $("#student_class").val(),
                "student_phone": $("#student_phone").val(),
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
                if (recv["status"] == "true") {
                    alert("成功，信息已更新")
                    $(":input").val("")
                    location.reload();
                }
                ;
                if (recv["status"] == "false") {
                    alert("异常，请重试，或将信息补充完整");
                    location.reload();
                }
                ;
            }
        })
    }
</script>
</body>

</html>
