<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "home";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $pid = $_GET['pid'];
            $cid = $_GET['cid'];
            $postreq = "insert into jobApply values(".base64_decode($id).",".base64_decode($cid).",".base64_decode($pid).",'".date('Y-m-d H:i:s')."')";
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