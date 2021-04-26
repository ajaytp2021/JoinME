<?php
require 'con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = 0;
    date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/Company/login.php");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{

    if($con){
        $totalSalary = 0;
        $ptitle = $_POST['ptitle'];
        $edate = $_POST['edate'];
        $dur = $_POST['dur'];
        $pexpire = $_POST['pexpire'];
        $budget = $_POST['budget'];
        $cid = base64_decode($id);
        $desc = $_POST['desc'];
        $data = json_decode(base64_decode($_POST['data']), true);
        $date = date("Y-m-d");
        $season = "";
        $arr = [];
        $levels = [];
        $jTitle = [];
        $salaries = [];
        $eachTotal = [];

        


        $check = "select * from posts where CId=$cid and pTitle='$ptitle' and descr='$desc' and EDate='$pexpire' and tExp=$budget";
        $insert = "insert into posts values (0, $cid, '$ptitle', '$desc', '$pexpire', $budget, '$date', '$edate.$dur(s)')";
        $insertSkills = "insert into prjSkills values";


        
        
        if($res = mysqli_query($con, $check)){
            if(mysqli_num_rows($res) == 0){
        if(mysqli_query($con, $insert)){
          $pid = mysqli_insert_id($con);
          $insertSkills = "insert into prjSkills values";

          $c = 0;
          foreach($data as $value){
              if(count($data)-1 == $c){
                  $insertSkills = $insertSkills." (0, $pid, $cid, '".base64_decode($value['type'])."', ".intval($value['no']).")";
              }else{
                $insertSkills = $insertSkills." (0, $pid, $cid, '".base64_decode($value['type'])."', ".intval($value['no'])."),";
              }
              $c = $c + 1;
          }

          if(mysqli_query($con, $insertSkills)){
            echo "<script>window.alert('Job successfully posted')
            window.location.replace('../Company/postjob.php?rawvalue=".$val."')
            </script>";

          }else{
              echo mysqli_error($con);
          }

        }else{
            echo mysqli_error($con);
        }
    }else{
        echo "<script>window.alert('Job already posted')
            window.location.replace('../Company/postjob.php?rawvalue=".$val."')
            </script>";
    }
}else{
    echo mysqli_error($con);
}
        
   

    }else{
        echo "Connection problem";
    }

}
}

?>