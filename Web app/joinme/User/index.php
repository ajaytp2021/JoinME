<?php
require '../php/con.php';
session_start();
if($con){
if(!isset($_SESSION['loginuser']) || !isset($_SESSION['uid']) || $_SESSION['loginuser'] == null || $_SESSION['uid'] == null){
    header("Location: login.php");
}else{
    header("Location: home.php?rawvalue=".$_SESSION['loginuser']);
}
}
?>