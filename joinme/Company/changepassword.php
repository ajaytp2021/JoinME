<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
$_SESSION['sidebarc'] = "profile";
    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";

if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $company = "select company.*, address.* from ((company inner join address on company.CId=address.CUId inner join login on company.CId=login.Lid and company.CId=".base64_decode($id)." and login.type=1)) LIMIT 1";
        
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
    <li class="breadcrumb-item active" aria-current="page">CHANGE PASSWORD</li>
  </ol>
</nav>
</div>


<?php

 if($res = mysqli_query($con, $company))
 {
   if(mysqli_num_rows($res) > 0){
     if($row = mysqli_fetch_array($res)){

?>
<div class="container h-100">
    
    <div class="row align-items-center h-100">
    <div class="d-inline-flex p-2 col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12">
                <div class="card-body">
                    <div id="msg"></div>
                    <div class="w-100 align-items-center mx-auto justify-content-center" enctype="multipart/form-data">
                        <form action="" method="POST" class="row w-100">
                        <div class="card card-body border-0 ml-5 mr-5">
                        <div class="input-group w-auto mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Old password</span>
  </div>
  <input type="password" aria-label="" class="form-control" name="oldpass" placeholder="Enter old password" id="old">
  <div class="invalid-feedback">
  Should enter old password to change.
      </div>
</div>
                        <div class="input-group w-auto">
  <div class="input-group-prepend">
    <span class="input-group-text">New password</span>
  </div>
  <input type="password" aria-label="" class="form-control" name="newpass" placeholder="Enter new password" id="new">
  <input type="password" aria-label="" class="form-control" name="newrepeatpass" placeholder="Repeat new password" id="newrepeat">
  <div class="invalid-feedback" id="errorcode">
      </div>
      <div class="valid-feedback" id="correctcode">
      </div>
</div>
</div>
                        <div class="form-group has-error has-feedback col-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 w-100 mx-auto align-items-center mb-0">
                        <button type="submit" class="btn btn-primary" name="updatepass" onclick="return confirm('Do you want to update your password?')">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

    <?php
     }
    }
  }
?>
<script src="../js/jquery.js"></script>
<script>
var correctcode = document.getElementById('correctcode');
var errorcode = document.getElementById('errorcode');
var newpass = document.getElementById('new');
newpass.onkeyup = function(){
  if(newpass.value.length < 8){
    if(!newpass.classList.contains("is-invalid")){
    newpass.classList.add("is-invalid");
    }
    errorcode.innerHTML = "Password must be 8 or more";
  }else{
    newpass.classList.remove("is-invalid");
    if(!newpass.classList.contains("is-valid")){
    newpass.classList.add("is-valid");
    }
    errorcode.innerHTML = "";
  }
}

var newrepeatpass = document.getElementById('newrepeat');
newrepeatpass.onkeyup = function(){
  if(newpass.value != newrepeatpass.value){
    if(!newrepeatpass.classList.contains("is-invalid")){
    newrepeatpass.classList.add("is-invalid");
    }
    errorcode.innerHTML = "Password mismatch";
    correctcode.innerHTML = "";
  }else{
    newrepeatpass.classList.remove("is-invalid");
    if(!newrepeatpass.classList.contains("is-valid")){
    newrepeatpass.classList.add("is-valid");
    }
    errorcode.innerHTML = "";
    correctcode.innerHTML = "Password match, Go ahead.";
  }
}

var old = document.getElementById('old');
old.onkeyup = function(){
  if(old.value.length == 0){
    if(!old.classList.contains("is-invalid")){
    old.classList.add("is-invalid");
    }
  }else{
    old.classList.remove("is-invalid");
  }
}






</script>

         </div>
       </div>
    </div>



</body>
</html>

<?php

if(isset($_POST['updatepass'])){
  $old = mysqli_real_escape_string($con, $_POST['oldpass']);
  $new = mysqli_real_escape_string($con, $_POST['newpass']);
  $newrepeat = mysqli_real_escape_string($con, $_POST['newrepeatpass']);
  $salt = "Joinme2020";
  if($old != null){
    if($new == $newrepeat){
      $checkoldpass = "select pass from login where Lid=".base64_decode($id);
      $res = mysqli_query($con, $checkoldpass);
      $pass = mysqli_fetch_array($res)['pass'];
      $old = hash('gost', $old.$salt);
      $new = hash('gost', $new.$salt);
      if($old == $pass){
        if($new == $pass){
          echo '<script>
          window.alert("This password is match with old password");
          </script>
          ';
        }else{
        $update = "update login set pass='$new' where Lid=".base64_decode($id);
        if(mysqli_query($con, $update)){
          echo '<script>
          window.alert("Password updated");
          </script>
          ';
        }else{
          echo '<script>
          window.alert("Error in password update");
          </script>
          ';
        }
      }
      }else{
        echo '<script>
          window.alert("Old password you entered is wrong");
          </script>
          ';
      }
    }else{
      echo '<script>
          window.alert("New password mismatch");
          </script>
          ';
    }
  }else{
    echo '<script>
          window.alert("Old password empty");
          </script>
          ';
  }
}

        }
    }
}
?>