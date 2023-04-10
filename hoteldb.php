<?php
$servername = "localhost";
$username = "root";
$password = "00000000";
$dbname = "hotel";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Connection fail".mysqli_connect_error());
} 
?>