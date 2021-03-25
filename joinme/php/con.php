<?php
// $con = mysqli_connect('localhost', 'root', '', 'joinme');
$server = "localhost";
$dbUname = "root";
$pass = "";
$dbName = "joinmePrj";
$con = mysqli_connect($server, $dbUname, $pass, $dbName);
if(!$con){
die("Failed".mysqli_connect_error());
} 

?>