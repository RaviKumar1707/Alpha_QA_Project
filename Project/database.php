<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "alphaproject";
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if(!$conn){
    die("Something went wrong!!");
} 
?>