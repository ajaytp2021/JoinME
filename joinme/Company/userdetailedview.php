<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
    $_SESSION['sidebarc'] = "postjob";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $uid = base64_decode($_GET['uid']);
          $isReq = false;
            $userview = "select users.*, address.* from ((users inner join address on users.UId=address.CUId inner join login on users.UId=login.Lid and login.approve=1 and users.UId=$uid))";
            $rating = "select round(avg(rating),1) as avg, count(rating) as total, (select count(rating) from rating where rating like '1%' and RRId=$uid) as one, (select count(rating) from rating where rating like '2%' and RRId=$uid) as two, (select count(rating) from rating where rating like '3%' and RRId=$uid) as three, (select count(rating) from rating where rating like '4%' and RRId=$uid) as four, (select count(rating) from rating where rating like '5%' and RRId=$uid) as five FROM `rating` where RRId=".$uid;
            $checkrating = "select * from rating where RSId=".base64_decode($id)." and RRId=$uid";
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
    <title><?php getName($con,'company', $id); ?></title>
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
if($res = mysqli_query($con, $userview)){
    if($row = mysqli_fetch_array($res)){
      ?>
<div class="w-100 text-left pl-3">
      <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 row w-100 justify-content-center">
      <img src="<?php echo $host.'/joinme/assets/images/profile_pic/'.$row['img']; ?>" class="img-fluid mr-3" style="clip-path: circle(50% at 50% 50%);" width="100px" alt="profile pic" onerror="this.onerror=null; this.src='../assets/images/icons/nobody.jpg'"></img>
      <div class="col-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 align-self-center">
      <p class="w-100 h3 font-weight-bold text-primary float-left text-uppercase text-bottom align-self-center mb-0"><?php echo $row['name']; ?></p>
      <div class="float-right">
        <?php if($rateRow[0] != null){ ?><div class="small pr-1 pl-1">Rating</div><div class="bgrate text-white w-auto text-center rounded font-weight-bold"><?php echo $rateRow[0]; ?></div><?php }?>
  </div>
    </div>
      </div>
      </div>
      </div>
      <div class="row w-100 ml-0 mb-2">
      <p class="col-2 col-xl-2 col-lg-3 text-secondary h6 float-left pl-0 pr-0">About User</p><p class="col-10 col-xl-10 col-lg-9 text-secondary float-left pl-0"><?php echo ": ".$row['about']; ?></p>
      </div>
      <div class="row w-100">
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Gender</p><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row['gender']; ?></p>
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Address</p><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row['address']; ?></p>
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Email</p><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row['email']; ?></p>
      <p class="w-100 h6 text-secondary float-left col-2 col-xl-2 col-lg-3">Phone</po><p class="col-10 col-xl-10 col-lg-9 text-secondary"><?php echo ": ".$row['phone']; ?></p>
      <div class="col-12 col-xl-12 col-lg-12 m-3">
      <div id="w-100">
      <?php
      if($r = mysqli_query($con, $checkrating)){
        if(mysqli_num_rows($r) == 0){ ?>
      <p class="text-secondary">Give rating</p>
				<div class="star-rating mb-4" id="ii">
					<span class="fa divya fa-star-o text-warning" id="one" data-rating="1" style="font-size:20px;"></span>
					<span class="fa fa-star-o text-warning" id="two" data-rating="2" style="font-size:20px;"></span>
					<span class="fa fa-star-o text-warning" id="three" data-rating="3" style="font-size:20px;"></span>
					<span class="fa fa-star-o text-warning" id="four" data-rating="4" style="font-size:20px;"></span>
					<span class="fa fa-star-o text-warning" id="five" data-rating="5" style="font-size:20px;"></span>
					<input type="hidden" name="whatever3" class="rating-value" value="1">
				</div>
        <a class="btn btn-primary mb-3" onclick="rateit();" id="rateit">Post rating</a>
        <?php }else{ ?>
        <hr class="w-100">
          <p class="text-secondary font-weight-bold">Rating you gave</p>
        <hr class="w-100">
        <div class="star-rating mb-4" style="pointer-events: none;">
        <?php
        $myrating = "select rating from rating where RSId=".base64_decode($id)." and RRId=$uid";
        if($res = mysqli_query($con, $myrating)){
          if($myraterow = mysqli_fetch_array($res)){
          $r = $myraterow[0];
        for($i = 0; $i < 5; $i++){ ?>
					<span class="fa <?php if($r <= 0){ echo 'fa-star-o'; }else{ echo 'fa-star'; } ?> text-warning" id="five" data-rating="5" style="font-size:20px;"></span>
          <?php $r--; } ?>
				</div>
        <a href="../php/ratedelete?rawvalue=<?php echo $val; ?>&rsid=<?php echo $id; ?>&rrid=<?php echo base64_encode($uid); ?>" class="btn btn-danger mb-3" onclick="return confirm('Do you want to delete this rating?');" id="ratedelete">Delete rating</a>
        <?php }else{ echo mysqli_error($con); } } } } ?>
        <hr class="w-100">
	</div>
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
  <span class="text-secondary h6 card p-3 text-center">This user has not rated by any company yet</span>
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
    <script src="../js/jquery.js"></script>
<script src="../js/starrating.js"></script>
<script>
  $('#rateit').prop('disabled', true);
function rateit(){
if(value == 0){
  $('#rateit').attr("href", "#");
}else{
  $('#rateit').attr("href", "../php/rate?rawvalue=<?php echo $val; ?>&rate="+value+"&rrid=<?php echo base64_encode($uid); ?>&rsid=<?php echo $id; ?>");
}
}
</script>

</body>
</html>

<?php
            }
        }
    }
}
?>