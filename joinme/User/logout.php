<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          
            $_SESSION["loginuser"] = null;
            $_SESSION["uid"] = null;
            header("Location: ".$host."/joinme/User/login");
        }
    }
}
?>