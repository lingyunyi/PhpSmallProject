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
$servername = "103.66.217.35";
$username = "a0314161734";
$password = "31467349";
$dbname = "a0314161734";

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


<script type="text/javascript" src="http://www.jq22.com/demo/clipboard.js-master201703170013/dist/clipboard.min.js"></script>
<div class="panel panel-default" style="text-align: center">
    <div class="panel-heading navbar-fixed-top" ><b>好省牛先生独家团队5月份福利</b></div>
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
                echo '<button type="button" class="list-group-item" onclick="return copyText(this);" value='.$row[1].'?>'.$row[1].'<span class="badge">点击复制</span></button>';
            };
            ?>
        </div>
    </div>
    <div class="panel-footer navbar-fixed-bottom" ><b>好省牛先生独家团队5月份福利</b></div>

</div>

</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script>

    function copyTextS(text, callback){ // text: 要复制的内容， callback: 回调
        var tag = document.createElement('input');
        tag.setAttribute('id', 'cp_hgz_input');
        tag.value = text;
        document.getElementsByTagName('body')[0].appendChild(tag);
        document.getElementById('cp_hgz_input').select();
        document.execCommand('copy');
        document.getElementById('cp_hgz_input').remove();
        if(callback) {callback(text)}
    }

    function copyText(ths) {
        console.log(ths)
        var inp = $(ths).prev()[0];
        copyTextS($(inp).attr("value"), function (){console.log('复制成功')})
        document.execCommand("Copy");  // 执行浏览器复制命令
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