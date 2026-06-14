<?php
$session_lifetime = 3600 * 24 * 2; 
session_set_cookie_params($session_lifetime);
session_start() ;
ob_start();
$link=new mysqli("localhost", "chiplug_nvidia", "chiplug_nvidia", "chiplug_nvidia") ; 
date_default_timezone_set("Africa/Lagos");
$dateTime=$dates = date('d-m-Y H:i:s');
$date = date('d-m-Y');
$time = time();
$fileName=$_SERVER['PHP_SELF'];
$mainFilename=pathinfo($fileName, PATHINFO_FILENAME) ;
$sitelink="https://localhost/invest";
$dollar="₦";
$point="BP";

$hour = date("H"); // Get the current hour in 24-hour format

if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning!";
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = "Good Afternoon!";
} elseif ($hour >= 18 && $hour < 24) {
    $greeting = "Good Evening!";
} else {
    $greeting = "Hello!";
}



?>