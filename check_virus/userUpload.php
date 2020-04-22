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

<?// error_reporting(E_ERROR);
//ini_set("display_errors","Off");?>


<?
require_once "tools.php"
?>

<nav id="nav" class="navbar navbar-default" style="margin-bottom: 0px;min-height: 43px;">
</nav>
<br>
<div class="container" style="background: rgba(255, 255, 255, 0.5);padding-top: -3px">
    <div class="panel panel panel-success" id="form">
        <form action="userUpload.php" method="post"
              enctype="multipart/form-data">
            <br/>
            <label for="file">文件名:</label>
            <input type="file" name="file" id="file"/>
            <br/>
            <input type="submit" name="submit" value="提交：是否为病毒"/>
        </form>
        <br>
    </div>
    <div class="panel panel panel-success" id="show">
        <ul class="list-group">
            <li style="list-style: none">
                是否为病毒：
                <b><?php echo $strr[0]; ?></b><br>
                病毒名为：
                <b><?php echo $strr[1]; ?></b>
            </li>
        </ul>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
</script>
</html>