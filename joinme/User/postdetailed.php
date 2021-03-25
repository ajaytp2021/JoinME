<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "home";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $postDetails = base64_decode($_GET['details']);
          $postid = $_GET['pid'];
          $cid = $_GET['cid'];
          $isReq = false;
          $onPrj = false;
          $check = "select status from usersOnProject where UId=".base64_decode($id);
            $checkreq = "select * from jobApply where UId=".base64_decode($id)." and PId=".base64_decode($postid)." and CId=".base64_decode($cid);
            if($r = mysqli_query($con, $check)){
              $row = mysqli_fetch_array($r);
              if($row[0] == 0){
                $onPrj = false;
            if($res = mysqli_query($con, $checkreq)){
              if(mysqli_num_rows($res) == 0){
                $isReq = false;
              }else{
                $isReq = true;
              }
            }
          }else{
            $onPrj = true;
          }
        }
          
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,'users', $id); ?></title>
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
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item" aria-current="page"><a href="javascript: window.history.back();">JOB LIST</a></li>
    <li class="breadcrumb-item active" aria-current="page">JOB DETAILED VIEW</li>
  </ol>
</nav>
</div>

<?php
if($res = mysqli_query($con, $postDetails)){
  if(mysqli_num_rows($res) != 0){
    if($row = mysqli_fetch_array($res)){
      ?>
<div class="w-100 text-left pl-3">
      <p class="w-100 h3 font-weight-bold text-primary float-left text-uppercase"><?php echo $row[2]; ?></p>
      <p class="w-100 text-secondary float-left pt-0 mb-1">Company : <a href="companydetailedview?rawvalue=<?php echo $val; ?>&cid=<?php echo $cid; ?>"><?php echo $row['cname']; ?></a></p>
      <p class="w-100 text-secondary float-left pt-0 mb-1"><?php echo $row[7]." - ".$row[6]; ?></p>
      <p class="w-100 text-secondary float-left pt-0 mb-1">No.of Employees needed : <?php echo $row[5]; ?></p>
      <p class="w-100 text-secondary float-left pt-0 mb-1">Salary : Rs.<?php echo $row['salary']; ?></p>
      <p class="w-100 text-secondary float-left pt-0 mb-2">End Date : <?php echo $row[4]; ?></p>
      <p class="col-2 col-xl-2 col-lg-2 text-secondary h6 float-left pl-0 pr-0">About project : </p><p class="col-10 col-xl-10 col-lg-10 text-secondary float-left pl-0"><?php echo $row[3]; ?></p>
      <?php if(!$onPrj){ ?>
      <a href="<?php if(!$isReq){ echo "../php/requestjob?rawvalue=$val&pid=$postid&cid=".base64_encode($row[1]); }else{ echo "#"; } ?>" class="btn btn-primary <?php if($isReq){ echo 'disabled'; } ?>"><?php if(!$isReq){ echo 'Request Job'; }else{ echo 'Already Requested'; } ?></a>
      <?php }else{ ?>
      <p class="card bg-info text-white text-center small p-3">You're already involved in a project, so you can't apply for any job until the current job is being completed.</p>
      <?php
      }
      ?>
</div>

          <?php
    }
  }else{
    ?>
    <div class="w-100 h-100">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No job posts are currently available</p>
</div>
    <?php
  }
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
?>