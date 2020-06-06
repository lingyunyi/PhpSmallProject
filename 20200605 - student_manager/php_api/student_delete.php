<?php

require "../php_model/mysql_connect.php";

$nid = $_GET["nid"];

if ($nid != ""){
    $sql = 'DELETE FROM student_info WHERE id = '."{$nid}";
    $con = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) == 1) {
        //如果影响成功
        echo "<script>alert('删除成功')</script>";
        echo '<script>location.href="../student_info.php"</script>';
    } else {
        //如果错误先回滚
        mysqli_rollback($conn);
        //最终关闭数据库
        mysqli_close($conn);
        // 结束指令
        echo "<script>alert('失败，请重试')</script>";
        echo '<script>location.href="../student_info.php"</script>';
    }
}
