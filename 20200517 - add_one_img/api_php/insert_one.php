<?php
error_reporting(E_ALL || ~E_NOTICE);
require_once "../db_php.php";
function filterWords(&$str)
{
    $farr = array(
        "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        "/select\b|insert\b|update\b|delete\b|drop\b|;|\"|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
    );
    $str = preg_replace($farr, '', $str);
    $str = strip_tags($str);
    return $str;
}


$typex = $_POST['typex'];
if ($typex == "insert") {
    $title = $_POST['title'];
    $url = $_POST['url'];
    filterWords($title);
    filterWords($url);
    $is_who = "123";
    $sql = "INSERT INTO content (content, img_url, is_who) VALUES (" . "'{$title}'," . "'{$url}'," . "'{$is_who}'" . ")";
    $sttr = '{"status":"false"}';
    if (!empty($title) && !empty($url)) {
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) == 1) {
            //如果影响成功
            $sttr = '{"status":"true"}';
            echo $sttr;
            return true;
        } else {
            //如果错误先回滚
            mysqli_rollback($conn);
            //最终关闭数据库
            mysqli_close($conn);
            // 结束指令
        }
    }
    echo $sttr;
    return false;
}
$conn->close();