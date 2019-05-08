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
        if(empty($_POST['searchInput']) || strlen((string)$_POST['searchInput']) < 5) {
            // 如果没有任何输入，或者输入不大于5
            header("Location: php/notFound.html");
        }else{
            if(is_numeric($_POST['searchInput']))
            {
                //判断是否是字符串
                $select_sql = "select * from phonedata where Phone = {$_POST['searchInput']} order by id desc limit 2";
            }
            elseif (is_string($_POST['searchInput']))

            {
                //判断是否是数值型
                $select_sql = "select * from phonedata where Name = '{$_POST['searchInput']}' order by id desc limit 2";
            }
            else
            {
                //既不是字符，也不是数字
                header("Location: php/notFound.html");
                exit('既不是字符，也不是数字');
            }
            if(!empty($select_sql))
            {
                //获取查询结果
                $result = mysqli_query($connect,$select_sql);
                //对于查询获得的结果集，进行处理。返回的是枚举数组，只能遍历
                $data = mysqli_fetch_row($result);
                if( $data == null )
                {
                    //如果查询获得的结果为空的话
                    header("Location: php/notFound.html");
                    exit('结果为空');
                }
//                var_dump($select_sql);
//                var_dump(mysqli_num_rows($result),$data) ;
//                var_dump($data[0],"</br >");
//                mysqli_data_seek($result,1);
//                $data = mysqli_fetch_row($result);
//                var_dump($data[0],"</br >");
            }
            $row = &$data;
        }
        ?>
        <form action="" id="searchFrom">
                    <p style="font-size: 60px;font-weight: 400;font-family: '华文行楷'" id="whoName"><?php echo $row[2];?></p>
                <span id="dateOne">
                    <p style="font-weight: 900;margin-bottom: 15px;margin-top: 10px; letter-spacing: 1.5px; font-size: 28px; font-family:Poor Richard; scr:url('./font/PoorRichard.ttf') ; color: #18ffb5;" >
                        <?php echo $row[1];?>
                    </p>
                </span>
                <input type="text" id="phoneOne" name="phoneOne" placeholder="13888888888" oninput="value=value.replace(/[^\d]/g,'')" maxlength="11" autocomplete="off" value="<?php echo $row[3];?>" readonly="readonly">
                <?php
                    mysqli_data_seek($result,1);
                    $data = mysqli_fetch_row($result);
                    $row = &$data;
                    if($data != null) {
                        ?>
                        <span id="dateTwo">
                            <p style="font-weight: 900;margin-bottom: 15px;margin-top: 15px; letter-spacing: 1.5px; font-size: 28px; font-family:Poor Richard; scr:url('./font/PoorRichard.ttf'); color: #18ffb5;">
                                <?php echo $row[1]; ?>
                            </p>
                        </span>
                        <input type="text" id="phoneTwo" name="phoneTwo" placeholder="13888888888" readonly="readonly"
                               autocomplete="off" value="<?php echo $row[3]; ?>">
                        <?php
                    }
            ?>
        </form>
        <?php
            mysqli_close($connect);
        ?>
    </div>
</div>
</body>
</html>
