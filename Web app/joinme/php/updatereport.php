<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $pid = base64_decode($_GET["pid"]);
    $uid = base64_decode($_GET["uid"]);
    $code = base64_decode($_GET["code"]);
    $desc = base64_decode($_GET["desc"]);
    $arr = [];
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/User/login.php");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $date = date('Y-m-d');
            $ins = "insert into dailyWorkReport values (0, $pid, $uid, '$date', '$code', '$desc')";
          if(mysqli_query($con, $ins)){
                    $arr[] = array("res" => "success");
                    echo json_encode($arr);
          }else{
            $arr[] = array("res" => "error", "msg" => $pid." ".$uid." ".$code." ".$desc);
            echo json_encode($arr);
          }
        }
    }
}
        
?>