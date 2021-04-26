<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = base64_decode($_SESSION['uid']) : $id = "";
    date_default_timezone_set('Asia/Kolkata');
    $_SESSION['sidebaru'] = "home";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/User/login.php");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $pid = base64_decode($_GET['pid']);
            $cid = base64_decode($_GET['cid']);

            $postreq = "insert into jobApply values($id, $cid, $pid, '".date('Y-m-d H:i:s')."')";
            if(mysqli_query($con, $postreq)){
                echo "<script>window.alert('Job requested successful');
                window.history.back()
                </script>";
            }else{
                echo mysqli_error($con);
            }
        }
    }
}
?>