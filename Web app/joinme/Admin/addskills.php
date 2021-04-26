<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $_SESSION['sidebar'] = "addskills";
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/Admin/login.php");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            
          $allskills = "select * from skills";
        
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
    <title>Dashboard</title>
</head>


<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Admin Dashboard
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100 overflow-hidden span6">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 overflow-auto span6 border-left">
       <form action="../php/addskill.php" method="POST" class="col-xl-12 col-lg-12 col-md-12">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center p-5">
       <div class="input-group input-group-lg col-xl-5 col-lg-5 w-100">
  <input type="text" name="skill" class="form-control" aria-label="skills add" aria-describedby="inputGroup-sizing-lg" placeholder="Skill Name" required>
</div>
        <div class="col-xl-12 col-lg-12 col-md-12 m-3">
<input type="submit" class="btn btn-danger" name="addskillbtn" value="Add Skill" onclick="return confirm('Do you want to add this skill?')">
        </div>
        
        <?php
        if($res = mysqli_query($con, $allskills))
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
        <ul class="list-group pl-3 card card-body col-xl-6 col-lg-6 col-md-6 mb-3 hvr-overline-reveal">
            <li class="d-flex align-content-center">
              <h6 class="text-secondary font-weight-bold mr-3"><?php echo $no += 1; ?>.</h6> <h6 class="text-secondary font-weight-bold w-100 text-left h-100"><?php echo $row[1]; ?></h6><a href="<?php echo $host; ?>/php/deleteskill.php?rawvalue=<?php echo $val; ?>&id=<?php echo $row[0]; ?>" class="float-right text-right" onclick="return confirm('Do you want to delete <?php echo $row[1]; ?>?')"><img src="../assets/images/icons/delete.svg"></img></a>
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

</body>
</html>

<?php
        }
    }
}
?>