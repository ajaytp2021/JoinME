<?php
require '../php/con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/Admin/login.php");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          
            $_SESSION["login"] = null;
            header("Location: ".$host."/Admin/login.php");
        }
    }
}
?>