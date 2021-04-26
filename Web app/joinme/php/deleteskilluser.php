<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $id = base64_decode($_GET["id"]);
    $skid = base64_decode($_GET["skid"]);
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/User/login.php");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $allskills = "delete from userSkill where SKId=$skid and UId=$id";
          $check = "select * from userSkill where SKId=$skid and UId=$id";
          if(mysqli_query($con, $allskills)){
              if($res = mysqli_query($con, $check)){
                  if(mysqli_num_rows($res) == 0){
                    echo '<script>
                    window.alert("Successfully deleted")
                    window.location="'.$host.'/User/addskills.php?rawvalue='.$val.'"</script>';
                  }
              }
          }else{
              echo '<script>
              window.alert("Something went wrong")
              window.location="'.$host.'/Uses/addskills.php?rawvalue='.$val.'"</script>';
          }
        }
    }
}
        
?>