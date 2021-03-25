<?php
require 'con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $id = 0;
    $type = "";
    $val = $_GET["rawvalue"];
    $id = $_GET["id"];
    $type = $_GET["t"];
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/joinme/Admin/login");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $update = "";
            if($type == "approvedcompanies"){
                $update = "update login set approve=2 where LId=$id and type=1";
            }else if($type == "approvedusers"){
                $update = "update login set approve=2 where LId=$id and type=2";
            }else{
                $update = "error";
            }

            if(mysqli_query($con, $update)){
                echo "<script>
                window.alert('Successfully blocked');
                window.location.href='".$host."/joinme/Admin/$type?rawvalue=$val';
                </script>";
            }else{
                echo "Something went wrong";
            }
        
        }
    }
}
?>