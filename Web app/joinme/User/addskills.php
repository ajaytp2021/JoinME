<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "addskills";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/User/login.php");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $skills = "select skills.* from userSkill inner join skills on userSkill.SKId=skills.SKId where userSkill.UId=".base64_decode($id);
          $selectskill = "select * from skills";
        
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/icons.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/hover.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,"users", $id); ?></title>
</head>


<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    User Account
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100 overflow-hidden span6">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 overflow-auto span6 border-left">
       <nav aria-label="breadcrumb" class="mt-2">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">ADD YOUR SKILL SET</li>
  </ol>
</nav>
       <form action="" method="POST" class="col-xl-12 col-lg-12 col-md-12">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center p-5">
       <div class="input-group input-group-lg col-xl-8 col-lg-8 w-100">
       <select class="form-control" id="skills" name="skills">
  <option value="novalue" selected disabled>Choose skill</option>
  <?php
  if($res = mysqli_query($con, $selectskill)){
    while($row = mysqli_fetch_array($res)){
    ?>
  <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
  <?php
    }
  }
  ?>
        </select>

</div>
        <div class="col-xl-12 col-lg-12 col-md-12 m-3">
<input type="submit" class="btn btn-danger" name="addskillbtn" value="Add Skill" onclick="return confirm('Do you want to add this skill?')">
        </div>
        
        <?php

        if($res = mysqli_query($con, $skills))
        {
          $no = 0;
          if(mysqli_num_rows($res) > 0){
            $rev = array();
          while($row = mysqli_fetch_array($res)){
            $rev[] = $row;
          }
          $rev = array_reverse($rev);
          foreach($rev as $row){
        ?>
        <ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3 hvr-overline-reveal">
            <li class="d-flex align-content-center">
              <h6 class="text-secondary font-weight-bold text-center h-100 mr-3"><?php echo $no += 1; ?>.</h6>
              <div class="col-xl-11 col-lg-11 col-md-11">
              <h6 class="text-secondary font-weight-bold w-100 text-left"><?php echo $row['skill']; ?></h6>
              </div>
              <a href="<?php echo $host; ?>/php/deleteskilluser.php?rawvalue=<?php echo $val; ?>&id=<?php echo $id; ?>&skid=<?php echo base64_encode($row[0]); ?>" class="float-right text-right" onclick="return confirm('Do you want to delete <?php echo $row[1]; ?>?')"><img src="../assets/images/icons/delete.svg"></img></a>
            </li>
          </ul>
          <?php
          }
        }else{ ?>
        <ul class="list-group pl-3 card card-body">
            <li class="d-flex align-content-center">
              <h6 class="text-secondary font-weight-bold mr-3 w-100 text-center">No skill added</h6>
            </li>
          </ul>
        <?php
        }
        }
          ?>
         </div>
       </div>
        </form>
    </div>
        </div>
    <script src="../js/jquery.min.js"></script>

        

</body>
</html>

<?php
if(isset($_POST['addskillbtn'])){
$skillid = $_POST['skills'];
$insert = "insert into userSkill values (0, $skillid, ".base64_decode($id).")";
$check = "select * from userSkill where SKId=$skillid and UId=".base64_decode($id);
if($res = mysqli_query($con, $check)){
  if(mysqli_num_rows($res) == 0){
if(mysqli_query($con, $insert)){
  echo '<script>alert("Skill added")
  window.history.back();
  </script>';
}{
  echo mysqli_error($con);
}
  }else{
  echo '<script>alert("Skill already added")
  window.history.back();
  </script>';
  }
}else{
  echo mysqli_error($con);
}
}

        }
    }
}
?>