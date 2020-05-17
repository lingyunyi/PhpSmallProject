<?php
error_reporting(E_ALL || ~E_NOTICE);
session_start();
$username = $_GET["username"];
if (!empty($username) || !empty($_SESSION["username"])) {
    $_SESSION["username"] = $username;
    ?>

    <!DOCTYPE html>
    <?php session_start(); ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>欢迎登入</title>
        <link rel="stylesheet" href="../static/Public/css/all_login.css">
        <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
        <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">

        <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
              crossorigin="anonymous">

        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous"></script>
        <style>

        </style>
    </head>
    <body>


    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <section>
                    <div class="form-group">
                        <label for="content">请输入内容</label>
                        <input type="text" class="form-control" id="content" placeholder="请输入内容">
                    </div>
                    <div class="form-group">
                        <label for="uploadImg">请上传图片</label>
                        <input type="file" id="uploadImg">
                    </div>
                    <img src="" alt="" id="img_url_show" style="width: 100px;">
                    <button type="submit" class="btn btn-default" onclick="return Ajaxsend()">提交</button>
                </section>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th style="text-align: center">序号</th>
                        <th style="text-align: center">内容</th>
                        <th style="text-align: center">进入详情</th>
                        </thead>
                        <tbody>
                        <?php
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "root";
                        $dbname = "add_one_img";

                        // 创建连接
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        mysqli_set_charset($conn, "utf8");
                        mysqli_query($conn, "set character set 'utf8'");//读库
                        mysqli_query($conn, "set names 'utf8'");//写库
                        // 检测连接
                        if ($conn->connect_error) {
                            die("error " . $conn->connect_error);
                        }

                        $select_sql = "select * from content";
                        // 使用 mysqli 函数的 query 提交到数据库服务器运行
                        $result = mysqli_query($conn, $select_sql);
                        // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
                        while ($row = mysqli_fetch_row($result)) {
                            echo '<tr>';
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td><a href='show_details.php/?nid=" . $row[0] . "'>查看</a></td>";
                            echo '</tr>';
                        };
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $("#uploadImg").on("change", function () {
                // console.log(this.files);
                var cover = new FormData();
                var fileObj = document.getElementById('uploadImg').files[0];
                cover.append('uploadImg', fileObj)
                $.ajax({
                    processData: false,
                    contentType: false,
                    type: "post",
                    url: "/add_one_img/api_php/img_get.php",
                    data: cover,
                    success: function (recv) {
                        recv = JSON.parse(recv)
                        if (recv["status"] == "true") {
                            console.log(recv)
                            $("#img_url_show").attr("src", recv["url"]);
                            alert("上传成功")
                        } else {
                            alert("失败，请重试......,只能上传图片")
                        }
                    }
                });
            });
        })
    </script>


    <script>
        function Ajaxsend() {
            if ($("#content").val() == "") {
                alert("请填写内容.......")
                return false;
            }
            $.ajax({
                type: "post",
                url: "/add_one_img/api_php/insert_one.php",
                data: {
                    "typex":"insert",
                    "title": $("#content").val(),
                    "url":$("#img_url_show").attr("src")
                },
                success: function (recv) {
                    recv = JSON.parse(recv)
                    if (recv["status"] == "true") {
                        alert("添加成功")
                        location.reload()
                    } else {
                        alert("添加失败")
                        location.reload()
                    }
                }
             });
        }
    </script>


    <?php
} else {
    Header("Location: \add_one_img/templates\all_login.php");
}

?>