<?php
require 'con.php';
require '../global/global.php';
session_start();
error_reporting(E_ALL);
    $val = $_GET["rawvalue"];
    $rate = $_GET["rate"];
    $rrid = base64_decode($_GET['rrid']);
    $rsid = base64_decode($_GET['rsid']);
        if($con){
            $rate = "insert into rating value($rsid, $rrid, $rate)";
            $check = "select * from rating where RSId=$rsid and RRId=$rrid";
            if($res = mysqli_query($con, $check)){
                if(mysqli_num_rows($res) == 0){
                    if($result = mysqli_query($con, $rate)){
                        echo "<script>
                        alert('Successfully rated')
                        window.history.back();
                        </script>";
                    }
                }else{
                    echo "<script>
                        alert('Already rated')
                        window.history.back();
                        </script>";
                }
            }
        }
?>