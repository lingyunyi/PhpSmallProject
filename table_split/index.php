<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>表格的分页技术</title>
    <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>
<body>
<!--  内容盒子  -->
    <div class="contentBox">
<!--    表格盒子    -->
        <div class="tableBox">
            <?php
            if(empty($_GET['page_id']))
            {
                echo '<a href="index.php?page_id=1">技术不行只能这样提示...</a>';
                echo "<br/>";
                exit('还有....别乱搞事......');
            }
            ?>
            <table border="1" style="text-align: center">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>存储时间</th>
                        <th>用户姓名</th>
                        <th>用户电话</th>
                    </tr>
                </thead>
                <tbody>
<!--  30条正好合适  -->
<?php

                    function select_data($page)
                    {
                        // 使用mysqli函数，面向过程式连接
                        $connect = mysqli_connect('localhost','root','root','phone');
                        // 判断是否连接失败
                        if (mysqli_connect_errno($connect))
                        {
                            // 这里涉及到一个php的知识点，php是以 . 符号，进行字符串连接的。
                            echo '连接 Mysql 失败:' . mysqli_connect_error();
                        }
                        // 如果使用mysqli 面向对象式的方法的话，一般设置默认字符集比较好
                        mysqli_set_charset($connect,'utf8');
                        // 这时候就可以进行 SQL 语句的语法使用了
                        $min = ((int)$page - 1) * 30;
                        $select_sql = "select * from phonedata limit {$min},30";
                        /**
                         *  select * from table limit m,n
                         *  其中m是指记录开始的index，从0开始，表示第一条记录
                         *  n是指从第m+1条开始，取n条。
                         */
                        if($_GET['page_id'] == "lastest")
                        {
                            $select_sql = "select * from phonedata order by id desc limit 30";
                        }
                        // 使用 mysqli 函数的 query 提交到数据库服务器运行
                        $result = mysqli_query($connect,$select_sql);
                        // 这里的 变量result 只是结果集，并不能直接用来展示，类似一个对象指针一般。
                        while ($row = mysqli_fetch_row($result))
                        {
                            echo '<tr>';
                            echo "<td>".$row[0]."</td>";
                            echo "<td>".$row[1]."</td>";
                            echo "<td>".$row[2]."</td>";
                            echo "<td>".$row[3]."</td>";
                            echo '</tr>';
                        }
                        mysqli_free_result($result);
                        mysqli_close($connect);
                    }
                    select_data($_GET['page_id'])
?>
<!--  30条正好合适  -->
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="index.php?page_id=1">首页</a></td>
                    <td><a href=<?php if($_GET['page_id'] > 1)
                    {
                        $next_up = (int)$_GET['page_id'] - 1;
                        echo "index.php?page_id={$next_up}";

                    }else {echo "index.php?page_id=1";}?>>上一页</a></td>

                    <td><a href="<?php if($_GET['page_id'] > 0)
                    {
                        $next_down = (int)$_GET['page_id'] + 1;
                        echo "index.php?page_id={$next_down}";

                    }else {echo "index.php?page_id=1"; }?>">下一页</a></td>
                    <td><a href="index.php?page_id=lastest">末页</a></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>