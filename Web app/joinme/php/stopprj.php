<?php
require 'con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = 0;
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/Company/login.php");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{

    if($con){
   $id = base64_decode($id);
   $cpid = base64_decode($_GET['cpid']);

   $stop = "update companyProjects set status=2 where PId=$cpid and CId=$id";
   $changestatus = "update usersOnProject set status=0 where CPId=$cpid";
           if(mysqli_query($con, $stop)&&mysqli_query($con, $changestatus)){
            echo "<script>window.alert('Project has stopped.')
            window.history.back()
            </script>";
           }else{
               echo mysqli_error($con);
           }


    }

}
}

?>