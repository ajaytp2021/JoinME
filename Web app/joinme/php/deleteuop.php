<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $data = $_GET["arr"];
    $arr = [];
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/Company/login.php");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $deleteuop = "delete from usersOnProject where UId in ($data)";
          if(mysqli_query($con, $deleteuop)){
                    $arr[] = array("res" => "success");
                    echo json_encode($arr);
          }else{
            $arr[] = array("res" => "error");
            echo json_encode($arr);
          }
        }
    }
}
        
?>