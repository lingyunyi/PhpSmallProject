<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="referrer" content="no-referrer"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>index</title>
    <style>
    </style>
</head>
<body>
<?php require_once('tools.php');
error_reporting(E_ERROR);

ini_set("display_errors","Off");?>
<?php

if ($_FILES["file"]["error"] > 0) {
//    echo "Error: " . $_FILES["file"]["error"] . "<br />";
} else {
//    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//    echo "Type: " . $_FILES["file"]["type"] . "<br />";
//    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//    echo "Stored in: " . $_FILES["file"]["tmp_name"];
}
    $filename = $_POST['filename'];
    $str = file_get_contents($_FILES["file"]["tmp_name"]);
    $sql = "INSERT INTO file (name, content) VALUES (" . "'{$filename}',"."'{$str}'".")";

    if (!empty($str) && !empty($filename)){
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) == 1){
            //如果影响成功
            header("location:index.php");
        }else{
            //如果错误先回滚
            mysqli_rollback($conn);
            //最终关闭数据库
            mysqli_close($conn);
            // 结束指令
            return false;
        }
    }

?>


<nav id="nav" class="navbar navbar-default" style="margin-bottom: 0px;min-height: 43px;">
</nav>
<div class="container" style="background: rgba(255, 255, 255, 0.5);padding-top: -3px">
    <div class="panel panel panel-success " id="form">
        <form action="index.php" method="post"
              enctype="multipart/form-data">
            <label for="filename">文件名</label>
            <input type="text" class="form-control" id="filename" placeholder="文件名" name="filename">
            <br/>
            <label for="file">文件名:</label>
            <input type="file" name="file" id="file"/>
            <br/>
            <input type="submit" name="submit" value="Submit"/>
        </form>

    </div>
    <div class="panel panel panel-success" id="show">
        <ul class="list-group ">

                <?php
                $select_sql = "select * from file";
                // 使用 mysqli 函数的 query 提交到数据库服务器运行
                $result = mysqli_query($conn, $select_sql);
                // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
                while ($row = mysqli_fetch_row($result)) {
                    echo '<li class="list-group-item " style="margin-top: 20px;">';
                    echo "<h4>文件名：" . $row[1] . "</h4>";
                    echo '<div style="width: 100%;border-bottom: 2px solid black"></div>';
                    echo "<h5>内容为：" . $row[2] . "</h5>";
                    echo '</li>';
                };
                ?>
        </ul>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
</html>
