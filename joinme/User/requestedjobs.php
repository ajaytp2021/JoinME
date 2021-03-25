<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "requests";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $jobreq = "select jobApply.*, posts.*, company.cname, (select count(*) from usersOnProject where usersOnProject.CPId=jobApply.PId and usersOnProject.UId=".base64_decode($id).") as counts from jobApply inner join posts on jobApply.PId=posts.PId inner join company on company.CId=jobApply.CId where jobApply.UId=".base64_decode($id)." order by jobApply.applyDateTime desc";
          $showpagecount = 6;
              if(!isset($_GET['page'])){
                $page = 1;
              }else{
                $page = $_GET['page'];
              }
              if($countres = mysqli_query($con, $jobreq)){
                $totalcount = mysqli_num_rows($countres);
                $currentpagecount = ceil($totalcount / $showpagecount);
                $this_page_first_result = (($page - 1) * $showpagecount);
                $jobreq = $jobreq." LIMIT ".$this_page_first_result.", ".$showpagecount;
              }
            if($res = mysqli_query($con, $jobreq)){
              
            
        
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
    <li class="breadcrumb-item active" aria-current="page">MY JOB REQUESTS</li>
  </ol>
</nav>
</div>
<?php
$nr = mysqli_num_rows($res);
if($nr != 0){
  while($row = mysqli_fetch_array($res)){
?>
<a href="#" class="p-0 m-0 text-decoration-none col-xl-12 col-lg-12 col-md-12">
<ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3">
            <li class="d-flex align-content-center">
            <div class="w-100 h-auto row">
            <div class="col-xl-10 col-lg-10 col-md-10 mr-3 row">
            <h6 class="text-secondary text-left text-uppercase font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12"><?php echo $row['pTitle']; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12"><?php echo $row['jTitle']." - ".$row['Ulevel']; ?></small>
            <small class="text-secondary w-100 text-left text-uppercase col-xl-12 col-lg-12 col-md-12"><?php echo "No. of emoloyees needed : ".$row['NoUsers']; ?></small>
            <small class="text-secondary w-100 text-left text-uppercase col-xl-12 col-lg-12 col-md-12"><?php echo $row['cname']; ?></small>
            </div>
            </div>
              <div class="col-xl-2 col-lg-2 col-md-2 mr-3 row h-100 d-flex flex-column">
              <small class="text-secondary align-bottom h-auto w-100 float-right col-xl-12 col-lg-12 col-md-12 m-0 p-0 align-bottom h-100 align-text-bottom">Status</small>
              <small class="text-secondary align-bottom h-auto w-100 float-right col-xl-12 col-lg-12 col-md-12 m-0 p-0 align-bottom h-100 align-text-bottom mb-0 h-100"><?php if($row['counts'] == 0){ ?><p class="text-white bg-warning mb-0 rounded">Not yet accepted</p><?php }else{ ?><p class="text-white bg-success mb-0 rounded">Accepted</p><?php } ?></small>
             </div>
            </li>
            <?php if($row['counts'] !=1){ ?>
            <a href="../php/deletereq?rawvalue=<?php echo $val; ?>&uid=<?php echo $id; ?>&pid=<?php echo base64_encode($row['PId']); ?>" id="deletereq" class="align-self-end text-decoration-none small" onclick="return confirm('Do you want to remove this request?')" style="width: fit-content;"><img src="../assets/images/icons/delete.svg"> Delete this request</img></a><?php } ?>

          </ul>
          </a>
          <?php
  }
}else{
?>
<div class="w-100 h-100">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No job requests available</p>
</div>
<?php }
?>
<?php if($nr != 0){ ?>
<nav aria-label="...">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="requestedjobs?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="requestedjobs?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="requestedjobs?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
<?php } ?>
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