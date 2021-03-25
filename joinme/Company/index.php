<?php
require '../php/con.php';
session_start();
if($con){
if(!isset($_SESSION['logincompany']) || !isset($_SESSION['cid']) || $_SESSION['logincompany'] == null || $_SESSION['cid'] == null){
    header("Location: login");
}else{
    header("Location: home?rawvalue=".$_SESSION['logincompany']);
}
}
?>