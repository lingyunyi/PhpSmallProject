<?php
require_once "../db_php.php";
header('content-type:text/html charset:utf-8');
$dir_base = "../static/img/";     //文件上传根目录
//没有成功上传文件，报错并退出。
$ret = '{"status":"false","url":"none"}';

foreach ($_FILES as $file) {
    $upload_file_name = 'uploadImg';        //对应index.html FomData中的文件命名
    $filename = $_FILES[$upload_file_name]['name'];
    $gb_filename = iconv('utf-8', 'gbk', $filename);    //名字转换成gb2312处理
    //文件不存在才上传
    $isMoved = false;  //默认上传失败
    $MAXIMUM_FILESIZE = 50 * 1024 * 1024;     //文件大小限制    1M = 1 * 1024 * 1024 B;
    $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
    if ($_FILES[$upload_file_name]['size'] <= $MAXIMUM_FILESIZE &&
        preg_match($rEFileTypes, strrchr($gb_filename, '.'))) {
        $isMoved = @move_uploaded_file($_FILES[$upload_file_name]['tmp_name'], $dir_base . $gb_filename);        //上传文件
        $url_str = $dir_base.$gb_filename;
        $ret = '{"status":"true","url":"'.$url_str.'"}';
        echo $ret;
        return true;
    }

}
echo $ret;




?>