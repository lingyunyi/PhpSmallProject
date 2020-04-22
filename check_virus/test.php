<?php
function string2bytes($str){
    $bytes=array();
    for ($i=0; $i < strlen($str); $i++) {
        $tmp=substr($str, $i,1);
        $bytes[]=bin2hex($tmp);
    }
    return $bytes;
}

$ar = string2bytes("你");
$str_bytes = implode("",$ar);

var_dump($str_bytes);