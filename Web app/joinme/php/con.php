<?php
// $con = mysqli_connect('localhost', 'root', '', 'joinme');
$server = "localhost";
$dbUname = "ajaytpin_joinme";
$pass = "-Lz_w)SJK8Da";
$dbName = "ajaytpin_joinmePrj";
$con = mysqli_connect($server, $dbUname, $pass, $dbName);
if(!$con){
die(mysqli_connect_error());
} 

?>