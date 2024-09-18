<?php

$site_key="6LccWY0nAAAAANxDj1UcQWAtnWqTHrSU7p_KXWjT";
$secret_key = '6LccWY0nAAAAACaebflvBtlw3Kfp3X_5qo00cUtl';

$dbservername = "localhost";
$dbuser = "u526284483_harish";
$dbpass = "B@ba15041990";
$dbname = "u526284483_soorvihar";

$conn=mysqli_connect($dbservername,$dbuser,$dbpass,$dbname);
session_start();
date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL);

ini_set('error_reporting', E_ALL);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

