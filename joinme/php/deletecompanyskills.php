<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $id = base64_decode($_GET["cid"]);
    $levels = base64_decode($_GET['levels']);
    $jtitle = base64_decode($_GET['jtitle']);
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $allskills = "delete from companySalaryScale where CId=$id and levels=$levels and jTitle='$jtitle'";
          if(mysqli_query($con, $allskills)){
                    echo '<script>
                    alert("Deleted");
                    window.location="'.$host.'/joinme/Company/basesalary?rawvalue='.$val.'#skills"</script>';
                  
          }else{
              echo '<script>
              window.alert("Something went wrong")
              window.location="'.$host.'/joinme/Company/basesalary?rawvalue='.$val.'#skills"</script>';
          }
        }
    }
}
        
?>