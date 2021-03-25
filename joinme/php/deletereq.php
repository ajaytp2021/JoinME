<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $uid = base64_decode($_GET["uid"]);
    $pid = base64_decode($_GET["pid"]);
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/Admin/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $jobreq = "delete from jobApply where UId=$uid and PId=$pid";
          $check = "select * from jobApply where UId=$uid and PId=$pid";
          if(mysqli_query($con, $jobreq)){
              if($res = mysqli_query($con, $check)){
                  if(mysqli_num_rows($res) == 0){
                    echo '<script>
                    window.alert("Removed job request")
                    window.history.back();
                    </script>';
                  }
              }
          }else{
              echo '<script>
              window.alert("Something went wrong")
              window.history.back();
              </script>';
          }
        }
    }
}
        
?>