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
   $prtitle = base64_decode($_GET['prtitle']);
   $psdate = base64_decode($_GET['psdate']);
   $pcdate = base64_decode($_GET['duration']);
   $texp = base64_decode($_GET['texp']);

   $check = "select * from companyProjects where CPId=$cpid and CId=$id";
   $insert = "insert into companyProjects values (0, $id, $cpid, '$prtitle', '$psdate', '$pcdate', $texp, 1)";
   $changestatus = "update usersOnProject set status=1 where CPId=$cpid";
   if($res = mysqli_query($con, $check)){
       if(mysqli_num_rows($res) == 0){
           if(mysqli_query($con, $insert)){
               if(mysqli_query($con, $changestatus)){
            echo "<script>window.alert('Project has started')
            window.history.back()
            </script>";
               }
           }else{
               echo mysqli_error($con);
           }
       }else{
        echo "<script>window.alert('Already started')
        window.history.back()
        </script>";
       }
   }else{
    echo mysqli_error($con);

   }

    }

}
}

?>