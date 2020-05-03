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
    <title>管理员</title>
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
$sql1 = "select count(*) from cdk";
$data1 = mysqli_query($conn,$sql1);
$rows1=mysqli_fetch_array($data1);
$rowCount1 = $rows1[0];



?>




<div class="panel panel-default" style="text-align: center">
    <div class="panel-heading" >上传CDK</div>
    <div class="panel-body">
        <section>
            <div class="form-group">
                <label for="cdk_id">CDK：</label>
                <input type="text" class="form-control" id="cdk_id" placeholder="CDK" name="cdk_id">
            </div>
            <button type="submit" class="btn btn-default" style="width: 100%" onclick="send();">上传</button>
        </section>
    </div>
    <div class="panel-footer"><b>剩余CDK数量：<?php echo $rowCount1;?></b></div>
</div>

</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script>
    function send() {
        $.ajax({
            url: 'updata_cdk.php',
            type: "GET",
            data: {
                "cdk_id":$("#cdk_id").val(),
            },
            // 设置超时的时间XXs
            timeout: 30000,
            success: function (recv) {
                location.reload()
                console.log(recv)
                $("#cdk_id").val("")
            }
        })


    }

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
</html>