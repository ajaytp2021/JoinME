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
          $cid = base64_decode($_GET['cid']);
          $isReq = false;
            $companyview = "select company.*, address.* from ((company inner join address on company.CId=address.CUId inner join login on company.CId=login.Lid and login.approve=1 and company.CId=$cid))";
            $rating = "select round(avg(rating),1) as avg, count(rating) as total, (select count(rating) from rating where rating like '1%' and RRId=$cid) as one, (select count(rating) from rating where rating like '2%' and RRId=$cid) as two, (select count(rating) from rating where rating like '3%' and RRId=$cid) as three, (select count(rating) from rating where rating like '4%' and RRId=$cid) as four, (select count(rating) from rating where rating like '5%' and RRId=$cid) as five FROM `rating` where RRId=".$cid;
            $array = [];
            $rate = 0;
            if($res = mysqli_query($con, $rating)){
             $rateRow = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,'users', $id); ?></title>
    <style>
.heading {
    font-size: 25px;
    margin-right: 25px;
  }
  
  .fa {
    font-size: 25px;
  }
  
  .checked {
    color: orange;
  }
  
  /* Three column layout */
  .side {
    float: left;
    width: 15%;
    margin-top:10px;
  }
  
  .middle {
    margin-top:10px;
    float: left;
    width: 70%;
  }
  
  /* Place text to the right */
  .right {
    text-align: right;
  }
  
  /* Clear floats after the columns */

  
  /* The bar container */
  .bar-container {
    width: 100%;
    background-color: #f1f1f1;
    text-align: center;
    color: white;
  }
  
  /* Individual bars */
  .bar-5 {width: <?php echo $rateRow['five'] / $rateRow['total'] * 100; ?>%; height: 18px; background-color: #4CAF50;}
  .bar-4 {width: <?php echo $rateRow['four'] / $rateRow['total'] * 100; ?>%; height: 18px; background-color: #4CAF50;}
  .bar-3 {width: <?php echo $rateRow['three'] / $rateRow['total'] * 100; ?>%; height: 18px; background-color: #4CAF50;}
  .bar-2 {width: <?php echo $rateRow['two'] / $rateRow['total'] * 100; ?>%; height: 18px; background-color: #ff9800;}
  .bar-1 {width: <?php echo $rateRow['one'] / $rateRow['total'] * 100; ?>%; height: 18px; background-color: #f44336;}
  
  /* Responsive layout - make the columns stack on top of each other instead of next to each other */
  @media (max-width: 400px) {
    .side, .middle {
      width: 100%;
    }
    .right {
      display: none;
    }
  }

  .bgrate{
    background-color: <?php if($rateRow['avg'] >= 3){ echo '#4CAF50'; }else if(3 > $rateRow['avg'] && $rateRow['avg'] > 1){ echo '#ff9800'; }else{ echo '#f44336'; } ?>;
  }
    </style>
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
    <li class="breadcrumb-item" aria-current="page"><a href="javascript: window.history.back();">JOB DETAILED VIEW</a></li>
    <li class="breadcrumb-item active" aria-current="page">JOB DETAILED VIEW</li>
  </ol>
</nav>
</div>

<?php
if($res = mysqli_query($con, $companyview)){
    if($row = mysqli_fetch_array($res)){
      ?>
<div class="w-100 text-left pl-3">
      <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 row w-100 justify-content-center">
      <img src="<?php echo $host; ?>/joinme/assets/images/profile_pic/<?php echo $row[12]; ?>" class="rounded img-fluid logo col-2 col-xl-2 col-lg-2 col-md-2 col-sm-2" alt="You Logo" id="logo" width="10%" height="10%" onerror="this.onerror=null; this.src='../assets/images/icons/notfound.png'">
      <div class="col-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 align-self-center">
      <p class="w-100 h3 font-weight-bold text-primary float-left text-uppercase text-bottom align-self-center mb-0"><?php echo $row[1]; ?></p>
      <p class="w-100 small text-secondary float-left text-uppercase m-0 align-self-center"><?php $date = new DateTime($row[2]); echo "This company has started since ".$date->format('Y'); ?></p>
      <div class="float-right">
        <?php if($rateRow[0] != null){ ?><div class="small pr-1 pl-1">Rating</div><div class="bgrate text-white w-auto text-center rounded font-weight-bold"><?php echo $rateRow[0]; ?></div><?php }?>
  </div>
    </div>
      </div>
      </div>
      </div>
      <div class="row w-100 ml-0 mb-2">
      <p class="col-2 col-xl-2 col-lg-3 text-secondary h6 float-left pl-0 pr-0">About Company</p><p class="col-10 col-xl-10 col-lg-9 text-secondary float-left pl-0"><?php echo ": ".$row[11]; ?></p>
      </div>
      <div class="row w-100">
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Address</p><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row[4]; ?></p>
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Email</p><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row[9]; ?></p>
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Phone</po><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row[10]; ?></p>
      <div class="col-12 col-xl-12 col-lg-12 m-3">
      <?php if($rateRow[0] != null){ ?>
      <span class="heading">User Rating</span>
<p><?php echo $rateRow['avg']; ?> average based on <?php echo $rateRow['total']; ?> review(s).</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="text-secondary">5 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $rateRow['five']; ?></div>
  </div>
  <div class="side">
    <div class="text-secondary">4 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4"></div>
    </div>
  </div>
  <div class="side right">
    <div><div><?php echo $rateRow['four']; ?></div></div>
  </div>
  <div class="side">
    <div class="text-secondary">3 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3"></div>
    </div>
  </div>
  <div class="side right">
    <div><div><?php echo $rateRow['three']; ?></div></div>
  </div>
  <div class="side">
    <div class="text-secondary">2 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2"></div>
    </div>
  </div>
  <div class="side right">
    <div><div><?php echo $rateRow['two']; ?></div></div>
  </div>
  <div class="side">
    <div class="text-secondary">1 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1"></div>
    </div>
  </div>
  <div class="side right">
    <div><div><?php echo $rateRow['one']; ?></div></div>
  </div>
</div>
<?php }else{ ?>
  <span class="text-secondary h6 card p-3 text-center">This company has not rated by any employee yet</span>
<?php } ?>
      </div>
      </div>
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
}
?>