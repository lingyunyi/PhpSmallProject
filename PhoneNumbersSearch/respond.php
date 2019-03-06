<?php include "php/connect.php";session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    <link rel="stylesheet" href="./css/result.css">
</head>
<body>
<div class="mainBox">
    <div class="centerBox" style="top: 130px;">
        <?php
        if(!empty($_POST['searchInput'])){
            require "php/mysqlSearch.php";
            if($row['Name']==""){
                header("Location: php/notFound.html");
            }

        ?>
        <form action="" id="searchFrom">
                    <p style="font-size: 60px;font-weight: 400;font-family: '华文行楷'" id="whoName"><?php echo $row['Name'];?></p>
                <span id="dateOne">
                    <p style="font-weight: 900;margin-bottom: 15px;margin-top: 10px; letter-spacing: 1.5px; font-size: 28px; font-family:Poor Richard; color: #18ffb5;" >
                        <?php echo $row['Date'];?>
                    </p>
                </span>
                <input type="text" id="phoneOne" name="phoneOne" placeholder="13888888888" oninput="value=value.replace(/[^\d]/g,'')" maxlength="11" autocomplete="off" value="<?php echo $row['Phone'];?>" readonly="readonly">
                <span id="dateTwo" >
                    <p style="font-weight: 900;margin-bottom: 15px;margin-top: 15px; letter-spacing: 1.5px; font-size: 28px; font-family:Poor Richard; color: #18ffb5;">
                        <?php echo $row['Date'];?>
                    </p>
                </span>
                <input type="text" id="phoneTwo" name="phoneTwo" placeholder="13888888888" readonly="readonly" autocomplete="off" value="<?php echo $row['Phone'];?>">
        </form>
            <?php
        }
            mysqli_close($connect);
        ?>
    </div>
</div>
</body>
</html>
