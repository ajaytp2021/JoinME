<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $pid = $_GET["pid"];
    $data = $_GET["data"];
    $arr = [];
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            echo '<script>alert('.$data.'); window.history.back();</script>';
            $check = "select sum(status) as sum from usersOnProject where UId=".base64_decode($data);
            $checkcount = "select count(*), (select posts.NoUsers from posts where posts.PId=".base64_decode($pid).") from usersOnProject where CPId=".base64_decode($pid);
          $addutop = "insert into usersOnProject values (".base64_decode($pid).", ".base64_decode($data).", 1)";
          if($r = mysqli_query($con, $checkcount)){
              $countrow = mysqli_fetch_array($r);
              $curcount = $countrow[0];
              $realcount = $countrow[1];
          if($curcount <= $realcount){
          if($res = mysqli_query($con, $check)){
              $row = mysqli_fetch_array($res);
              if($row['sum'] == 0){
          if(mysqli_query($con, $addutop)){
                    echo '<script>alert("Successfully added this user to your project"); window.history.back();</script>';
          }else{
            echo '<script>alert("'.mysqli_error($con).'"); window.history.back();</script>';
          }
        }else{
            echo '<script>alert("This user has already involved in a project"); window.history.back();</script>';
        }
    }
}else{
    echo '<script>alert("Maximum no. of users already added. You cannot add any more users"); window.history.back();</script>';
}
}else{
    echo '<script>alert("Inform devepers"); window.history.back();</script>';
}
}
}
}
        
?>