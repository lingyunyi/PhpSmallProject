<?php
error_reporting(E_ALL || ~E_NOTICE);
session_start();
require_once "../db_php.php";
if (!empty($_SESSION["username"])) {
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
    <?php

    $nid = $_GET["nid"];
    $select_sql = "select * from content where id = '" . $nid . "'";
    var_dump($select_sql);
    // 使用 mysqli 函数的 query 提交到数据库服务器运行
    $result = mysqli_query($conn, $select_sql);
    // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
    while ($row = mysqli_fetch_row($result)) {
        echo "<div>" . $row[1] . "</div>";
        echo "<img src=../../" . $row[2] . " style='width:300px'>";
    };
    ?>
</div>
</body>

    <?php
} else {
    Header("Location: \add_one_img/templates\all_login.php");
}

?>