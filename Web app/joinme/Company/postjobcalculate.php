<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
$_SESSION['sidebarc'] = "postjob";
isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/Company/login.php");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          if(isset($_POST['calculate'])){
            $totalSalary = 0;
            $ptitle = $_POST['ptitle'];
            $durcount = $_POST['edate'];
            $dur = $_POST['dur'];
            $pexpire = $_POST['pexpire'];
            $budget = $_POST['budget'];
            $cid = $_POST['cid'];
            $desc = $_POST['desc'];
            $data = json_decode(base64_decode($_POST['data']), true);
            $month = 0;
            $season = "";
            $arr = [];
            $levels = [];
            $jTitle = [];
            $salaries = [];
            $eachTotal = [];

            foreach($data as $value){
              $jTitle = array_merge($jTitle, array(str_replace(',', '', base64_decode($value['type']))));
              $salaries = array_merge($salaries, array(str_replace(',', '', base64_decode($value['salary']))));
              $totalSalary = $totalSalary + str_replace(',', '', base64_decode($value['salary']));
            }

            foreach($data as $v){
              $eachTotal = array_merge($eachTotal, array(floor((($budget / $totalSalary ) * str_replace(',', '', base64_decode($v['salary']))))));
            }
            
      
            
            switch($dur){
              case "day":{
                $month = $durcount / 30;
                $seasion = "Day(s)";
              break;
              }
              case "week":{
                $month = $durcount / 4;
                $seasion = "Week(s)";
              break;
              }
              case "month":{
                $month = $durcount;
                $seasion = "Month(s)";
              break;
              }
            }
            
            for($i = 0; $i < count($jTitle); $i++){
              $x = floor((($eachTotal[$i]) / str_replace(',','',$salaries[$i])) * $month);
              $tExp = str_replace(',','',$salaries[$i]) * $x * $month;
              $profit = (str_replace(',','',$budget) - (str_replace(',','',$salaries[$i]) * $x * $month));
              if($x != 0){
                echo $tExp.' '.$x.' '.$profit.'<br>';
              }
            }

        
        
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/cardbadge.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    JoinME Home
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left h-100">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">CALCULATED SALARY OF JOB</li>
  </ol>
</nav>
<div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0 row w-100 justify-content-center">
<?php
for($i = 0; $i < count($levels); $i++){
  $x = floor((str_replace(',','',$budget)) / (str_replace(',','',$salaries[$i]) * $month));
  $tExp = str_replace(',','',$salaries[$i]) * $x * $month;
  $profit = (str_replace(',','',$budget) - (str_replace(',','',$salaries[$i]) * $x * $month));
  if($x != 0){
?>
<form action="../php/postjob.php" method="POST" class="w-100 col-xl-6 col-lg-6 col-md-6 pr-3 pl-5 pb-3">
  <div class="pl-3 card card-body <?php if($lvl[$i] == "Beginner"){?>beginner<?php } ?><?php if($lvl[$i] == "Intermediate"){?>intermediate<?php } ?><?php if($lvl[$i] == "Expert"){?>expert<?php } ?> row">
  <?php
   $_SESSION['desc'] = $desc;
   $_SESSION['salary'] = $salaries[$i];
   $_SESSION['tExp'] = $tExp;
   ?>
            <div class="d-flex align-content-center">
            <div class="row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12"><?php echo 'TITLE : '.$ptitle; ?></h6>
            <small class="text-secondary text-left col-xl-12 col-lg-12 col-md-12" name="exp"><?php echo 'Total employees needed : <b>'.$x.'</b>'; ?></small>
            <small class="text-secondary text-left col-xl-12 col-lg-12 col-md-12"><?php echo 'Expense amount calculated : <b>'.$tExp.'</b>'; ?></small>
            <small class="text-secondary text-left col-xl-12 col-lg-12 col-md-12"><?php echo 'Duration you expected : <b>'.$durcount.' '.$seasion.'</b>'; ?></small>
            <small class="text-secondary text-left col-xl-12 col-lg-12 col-md-12"><?php echo 'Profit expected : <b>'.floor($profit).'</b>'; ?></small>
            
            </div>
           
  </div>
            <div class="row justify-content-end m-2">
            <a href="../php/postjob.php?rawvalue=<?php echo $val."&title=".base64_encode($ptitle)."&desc=".base64_encode($desc)."&edate=".base64_encode($pexpire)."&nousr=".base64_encode($x)."&ulevel=".base64_encode($lvl[$i])."&jtitle=".base64_encode($skill)."&salary=".base64_encode($salaries[$i])."&texp=".base64_encode($tExp)."&months=".$month; ?>" class="btn btn-success w-100 pulsebtn" name="postjob">POST JOB</a>
            </div>
  </form>
  </div>
<?php
}else{
  if($i == 0){
  ?>
<h6 class="text-secondary text-left font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12 text-center m-5">No Data Found</h6>
<?php break; } }
          }
?>
</div>
       </div>
    </div>

</body>
</html>

<?php
          }
          }
    }
}
?>