<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $_SESSION['sidebar'] = "home";
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/joinme/Admin/login");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            
        
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/hover.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<script>
function approvedusers(){
      window.location.href = "<?php echo $host; ?>/joinme/Admin/approvedusers?rawvalue=<?php echo $val; ?>";
}
function approvedcompanies(){
      window.location.href = "<?php echo $host; ?>/joinme/Admin/approvedcompanies?rawvalue=<?php echo $val; ?>";
}
function newusers(){
      window.location.href = "<?php echo $host; ?>/joinme/Admin/newusers?rawvalue=<?php echo $val; ?>";
}
function newcompanies(){
      window.location.href = "<?php echo $host; ?>/joinme/Admin/newcompanies?rawvalue=<?php echo $val; ?>";
}
</script>

<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Admin Dashboard
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center">
        <a href="javascript: approvedusers()" class="card card-body hvr-float-shadow rounded col-12 col-sm-6 col-md-5 col-lg-3 col-xl-3 shadow-lg m-3 text-decoration-none" style="background-color: #eb7070">
         <div class="text-white font-weight-bold"><p class="display-2 font-weight-bold"><?php echo countUsers($con); ?></p><p>TOTAL APPROVED USERS</p></div>
         </a>
         <a href="javascript: approvedcompanies()" class="card card-body hvr-float-shadow rounded col-12 col-sm-6 col-md-5 col-lg-3 col-xl-3 shadow-lg m-3 text-decoration-none" style="background-color: #eb7070">
         <div class="text-white font-weight-bold"><p class="display-2 font-weight-bold"><?php echo countCompanies($con); ?></p><p>TOTAL APPROVED COMPANIES</p></div>
         </a>
         <a href="javascript: newusers()" class="card card-body hvr-float-shadow rounded col-12 col-sm-6 col-md-5 col-lg-3 col-xl-3 shadow-lg m-3 text-decoration-none" style="background-color: #49aa5c">
         <div class="text-white font-weight-bold"><p class="display-2 font-weight-bold"><?php echo newReqUsers($con); ?></p><p>NEW USER REGISTRATION REQUESTS</p></div>
         </a>
         <a href="javascript: newcompanies()" class="card card-body hvr-float-shadow rounded col-12 col-sm-6 col-md-5 col-lg-3 col-xl-3 shadow-lg m-3 text-decoration-none" style="background-color: #49aa5c">
         <div class="text-white font-weight-bold"><p class="display-2 font-weight-bold"><?php echo newReqCompanies($con); ?></p><p>NEW COMPANY REGISTRATION REQUESTS</p></div>
         </a>
         </div>
       </div>
    </div>

</body>
</html>

<?php
        }
    }
}
?>