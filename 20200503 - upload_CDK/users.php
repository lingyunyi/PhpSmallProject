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
    <link href="/static/css/all.css" rel="stylesheet" type="text/css">
    <title>用户界面</title>
    <style>

    </style>
</head>
<body>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "test";

// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($conn,"utf8");
mysqli_query($conn,"set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
// 检测连接
if ($conn->connect_error) {
    die("error " . $conn->connect_error);
}

?>



<div class="panel panel-default" style="text-align: center">
    <div class="panel-heading" >点击复制</div>
    <div class="panel-body">
        <input style="display: none" value="">
        <div class="list-group">
            <?php
            $select_sql = "select * from cdk";
            // 使用 mysqli 函数的 query 提交到数据库服务器运行
            $result = mysqli_query($conn, $select_sql);
            // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
            while ($row = mysqli_fetch_row($result)) {
                echo '<input style="display: none" value='.$row[1].'>';
                echo '<button type="button" class="list-group-item" onclick="return copyText(this);" value='.$row[1].'?>'.$row[1].'</button>';
            };
            ?>
        </div>
    </div>
    <div class="panel-footer"><b>好生牛先生独家团队5月份福利</b></div>

</div>

</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script>
    function copyText(ths) {
        console.log(ths)
        var inp = $(ths).prev()[0]
        $(inp).select(); // 选中文本
        console.log(inp);
        document.execCommand("copy"); // 执行浏览器复制命令
        alert("复制成功，请复制内容："+$(inp).attr("value"));

        $.ajax({
            url: 'delete_cdk.php?cdk_id='+$(inp).val(),
            type: "GET",
            data: {
                "ckd_id":$(inp).val()
            },
            // 设置超时的时间XXs
            timeout: 30000,
            success: function (recv) {
                location.reload()
                console.log(recv)
            }
        })


    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
</html>