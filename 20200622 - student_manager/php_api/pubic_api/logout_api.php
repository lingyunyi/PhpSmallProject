<?php
foreach($_COOKIE as $key=>$value){
    unset($_COOKIE[$key]);
}
foreach ($_COOKIE as $key => $value) {
    setcookie($key, null);
}
unset($_COOKIE);
var_dump($_COOKIE);
Header("Location:../../index.php");
?>