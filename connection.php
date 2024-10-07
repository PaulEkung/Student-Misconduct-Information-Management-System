<?php 
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "Musical+1937";
$dbName = "smms";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if(!$conn){
    die("Failed to connect");
}

