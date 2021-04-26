<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $data = $_GET["id"];
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/Admin/login.php");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $allskills = "delete from skills where SKId=$data";
          $check = "select * from skills where SKId=$data";
          if(mysqli_query($con, $allskills)){
              if($res = mysqli_query($con, $check)){
                  if(mysqli_num_rows($res) == 0){
                    echo '<script>
                    window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'"</script>';
                  }
              }
          }else{
              echo '<script>
              window.alert("Something went wrong")
              window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'"</script>';
          }
        }
    }
}
        
?>