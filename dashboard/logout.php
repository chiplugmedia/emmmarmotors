<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
session_start();
session_destroy();
setcookie('username', '', time() - 3600, "/");
setcookie('password', '', time() - 3600, "/");
unset($_COOKIE['username']);
unset($_COOKIE['password']);
header("location:$stream/login.php");
?>