<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
session_start();
session_destroy();
header("location:$stream/login");
?>