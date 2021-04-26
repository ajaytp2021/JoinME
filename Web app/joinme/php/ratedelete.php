<?php
require 'con.php';
require '../global/global.php';
session_start();
error_reporting(E_ALL);
    $val = $_GET["rawvalue"];
    $rrid = base64_decode($_GET['rrid']);
    $rsid = base64_decode($_GET['rsid']);
        if($con){
            $rate = "delete from rating where RSId=$rsid and RRId=$rrid";
                if($result = mysqli_query($con, $rate)){
                        echo "<script>
                        alert('Rating removed')
                        window.history.back();
                        </script>";
                }
            }
?>