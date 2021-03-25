<?php
require '../php/con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = 0;
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{

    if($con){
   $id = base64_decode($id); 
   $ptitle = base64_decode($_GET['title']);
   $desc = base64_decode($_GET['desc']);
   $edate = base64_decode($_GET['edate']);
   $nousr = base64_decode($_GET['nousr']);
   $ulevel = base64_decode($_GET['ulevel']);
   $jtitle = base64_decode($_GET['jtitle']);
   $salary = base64_decode($_GET['salary']);
   $texp = base64_decode($_GET['texp']);
   $date = date("Y-m-d");
   $months = base64_decode($_GET['months']);
   $dur = date("Y-m-d", strtotime( date( 'Y-m-'.date("d") )." +$months months"));
   $check = "select * from posts where CId=$id and pTitle='$ptitle' and descr='$desc' and EDate='$edate' and NoUsers=$nousr and Ulevel='$ulevel' and jTitle='$jtitle' and salary=$salary and tExp=$texp";
   $insert = "insert into posts values (0, $id, '$ptitle', '$desc', '$edate', $nousr, '$ulevel', '$jtitle', $salary, $texp, '$date', '$dur')";
   if($res = mysqli_query($con, $check)){
       if(mysqli_num_rows($res) == 0){
           if(mysqli_query($con, $insert)){
            echo "<script>window.alert('Job successfully posted')
            window.location.replace('../Company/postjob?rawvalue=".$val."')
            </script>";
           }else{
               echo mysqli_error($con);
           }
       }else{
           echo mysqli_error($con);
       }
   }else{
    echo mysqli_error($con);

   }

    }

}
}

?>