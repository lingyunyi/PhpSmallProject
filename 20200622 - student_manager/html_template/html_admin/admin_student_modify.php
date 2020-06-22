<?php
require_once '../../php_api\pubic_api\mysql_connect.php';

$grade = $_COOKIE["grade_c_id"];
if (empty($grade)) {
    Header("Location:../../index.php");
}
$nid = $_GET["nid"];
if (empty($nid)) {
    Header("Location:../../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人中心 - 管理登入中心</title>

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
        <li ><a href="admin_student_info.php"><span class="glyphicon glyphicon-tree-deciduous"></span>师生账号管理</a></li>
        <li class="active" style="display: none"><a href="admin_student_modify.php"><span class="glyphicon glyphicon-tree-deciduous"></span>师生账号修改</a></li>
        <li ><a href="admin_repasswd.php"><span class="glyphicon glyphicon-tree-deciduous"></span>修改自我密码</a></li>
        <li role="presentation" class="divider"></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">师生账号修改</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">师生账号修改</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="查询系统：任意字段查询" id="search" disabled="disabled">
                    </div>
                </div>
                <?php
                if(!empty($nid)) {
                    $sql = "select * from account_list where id = '{$nid}'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_all($result);
                }
                ?>
                <div class="panel-body">
                    <section>
                        <div class="form-group" style="display: none">
                            <label for="student_class">NID</label>
                            <input type="text" class="form-control" id="nid" name="nid"
                                   value="<?php if($row != null){echo $row[0][0]; }; ?>" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="student_class">ID</label>
                            <input type="text" class="form-control" id="login_account" name="login_account"
                                   value="<?php if($row != null){echo $row[0][1]; }; ?>" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="student_phone">姓名</label>
                            <input type="text" class="form-control" id="login_name" name="login_name"
                                   value="<?php if($row != null){echo $row[0][2]; }; ?>">
                        </div>
                        <div class="form-group">
                            <label for="student_phone">新密码</label>
                            <input type="text" class="form-control" id="login_re_passwd" name="login_re_passwd"
                                   value="<?php if($row != null){echo $row[0][3]; }; ?>">
                        </div>
                        <button type="submit" class="btn btn-default" onclick="return AjaxSend();">确认修改</button>
                    </section>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->

<script src="../../html_static/pubuic_static/js/jquery-1.11.1.min.js"></script>
<script src="../../html_static/pubuic_static/js/bootstrap.min.js"></script>
<script src="../../html_static/pubuic_static/js/bootstrap-datepicker.js"></script>
<script>

    function AjaxSend() {
        $.ajax({
            url: '../../php_api/admin_api/admin_account_modify_api.php',
            type: "POST",
            data: {
                "nid": $("#nid").val(),
                "login_name": $("#login_name").val(),
                "login_re_passwd": $("#login_re_passwd").val(),
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
                if(recv["status"] == "true"){
                    alert("信息修改成功。")
                    location.href = "admin_student_info.php"
                }else {
                    alert("信息修改失败，当前信息是否正确？")
                }
            }
        })
    }

</script>
</body>

</html>
