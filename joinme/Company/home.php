<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
$_SESSION['sidebarc'] = "home";
    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $listposts = "select companyProjects.*, posts.*, company.cname from companyProjects inner join posts on posts.PId=companyProjects.CPId inner join company on companyProjects.CId=company.CId where companyProjects.status=1 and companyProjects.CId=".base64_decode($id);
        
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
    <title><?php getName($con,'company', $id); ?></title>
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
    <li class="breadcrumb-item active" aria-current="page">OUR ACTIVE PROJECTS</li>
  </ol>
</nav>
</div>
<?php
if($res = mysqli_query($con, $listposts)){
  if(mysqli_num_rows($res) != 0){
    while($row = mysqli_fetch_array($res)){
      ?>

<ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-10 col-lg-10 col-md-10 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold text-uppercase w-100 col-xl-12 col-lg-12 col-md-12"><?php echo $row['prTitle']; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">Skill and level : <?php echo $row['jTitle']." - ".$row['Ulevel']; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">Total expenses computed : <?php echo $row['tExp']; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">No.of Employees needed : <?php echo $row['NoUsers']; ?></small>
            
            </div>
            </div>
           
            </li>
            <div class="col-xl-12 col-lg-12 col-md-12 row pb-2 w-100 justify-content-end">
            <small class="text-secondary text-left float-right"><a href="<?php echo "viewempre"; ?>">View employees and their reports</a></small>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 w-100 row justify-content-end">
            <small class="text-secondary text-right float-right mr-3"><?php echo $row['psDate']; ?></small>
            <small class="text-secondary text-right float-right"><?php echo $row['pcDate']; ?></small>
            </div>
          </ul>
          <?php
    }
  }else{
    ?>
<div class="w-100 h-100">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No active projects are currently available</p>
</div>
    <?php
  }
} ?>
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