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
    header("Location: ".$host."/User/login.php");
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
    <li class="breadcrumb-item active" aria-current="page">PROFILE</li>
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
                        <form action="../php/updateprofile.php" method="POST" class="row w-100">
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                <center><img src="<?php echo $host; ?>/assets/images/profile_pic/<?php echo $row[12]; ?>" class="rounded img-fluid logo" style="clip-path: circle(50% at 50% 50%);" alt="You Logo" id="logo" width="30%" height="30%" onerror="this.onerror=null; this.src='../assets/images/icons/nologo.jpg'"></center>
                        </div>
                       
                        
                        <input type="hidden" name="hidden" value="<?php echo $id; ?>">
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Phone</span>
  </div>
                            <input type="phone" class="form-control" placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon1" name="phone" value="<?php echo $row[10]; ?>" id="input">

                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Email</span>
  </div>
                            <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" id="email" onchange="" value="<?php echo $row[9]; ?>" id="input">

                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Company start since</span>
  </div>
                            <input type="text" class="form-control" placeholder="Company started since" aria-label="Company started since" aria-describedby="basic-addon1" onfocus="(this.type='date')" onblur="(this.type='text')" name="csdate" value="<?php echo $row[2]; ?>" id="input">

                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Pincode</span>
  </div>
                            <input type="number" class="form-control" placeholder="Pincode" aria-label="Pincode" aria-describedby="basic-addon1" name="pincode" value="<?php echo $row[5]; ?>" id="input">

                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Address</span>
  </div>
                        <textarea class="form-control" aria-label="With textarea" placeholder="Address" name="address" rows="4" id="input"><?php echo $row[4]; ?></textarea>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">District</span>
  </div>
                            <input type="text" class="form-control" placeholder="District" aria-label="District" aria-describedby="basic-addon1" name="district" value="<?php echo $row[6]; ?>" id="input">

                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">State</span>
  </div>
                            <input type="text" class="form-control" placeholder="State" aria-label="State" aria-describedby="basic-addon1" name="state" value="<?php echo $row[7]; ?>" id="input">

                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Country</span>
  </div>
                            <input type="text" class="form-control" placeholder="Country" aria-label="Country" aria-describedby="basic-addon1" name="country" value="<?php echo $row[8]; ?>" id="input">

                        </div>

                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">About your company</span>
  </div>
                        <textarea class="form-control" aria-label="About your company" rows="8" placeholder="About your company" name="about" id="input"><?php echo $row[11]; ?></textarea>
                        </div>

                        <!-- <div class="" -->
                        <div class="form-group has-error has-feedback col-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 w-100 mx-auto align-items-center mb-0">
                        <button type="submit" class="btn btn-primary float-right" name="updatecompany" onclick="return confirm('Do you want to update your profile?')">Update</button>
                        </div>
                        <a href="changepassword.php?rawvalue=<?php echo $val; ?>" class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">Change password</a>
                    </form>
                    </div>
                </div>
            </div>

    <?php
     }
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