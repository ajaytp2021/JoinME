<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $id = 0;
    $val = $_GET["rawvalue"];
    $id = $_GET["id"];
    $_SESSION['sidebar'] = "home";
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/Admin/login.php");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $user = "select users.*, address.* from ((users inner join address on users.UId=address.CUId inner join login on users.UId=login.Lid and login.approve=1 and users.UId=$id))";
            if($res = mysqli_query($con, $user))
            {
              $no = 0;
              if(mysqli_num_rows($res) > 0){
                if($row = mysqli_fetch_array($res)){

                
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
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left">
       <div class="container-fluid row h-auto w-100 pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb mb-5">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $host; ?>/Admin/dashboard.php?rawvalue=<?php echo $val; ?>">Home</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo $host; ?>/Admin/approvedusers.php?rawvalue=<?php echo $val; ?>">Total Approved Users</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row[1]." ( ID: ".$row[0]." )"; ?></li>
  </ol>
</nav>
</div>
<div class="container h-100">
    
    <div class="row align-items-center h-100">
    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2 col-1"></div>
    <div class="d-inline-flex p-2 col-lg-8 col-md-10 col-sm-8 col-xl-8 col-10">
                <div class="card-body">
                    <div class="row w-100 align-items-center mx-auto justify-content-center" enctype="multipart/form-data">
                        
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                <center><img src="<?php echo $host; ?>/assets/images/profile_pic/<?php echo $row[13]; ?>" class="rounded img-fluid logo" alt="You Logo" id="logo" style="clip-path: circle(50% at 50% 50%);" width="100px" onerror="this.onerror=null; this.src='../assets/images/icons/nobody.jpg'"></center>
                        </div>
                       
                        
                        
                        
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="number" class="form-control" placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon1" name="phone" value="<?php echo $row[11]; ?>" disabled>

                        </div>
                        
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" id="email" onchange="" value="<?php echo $row[10]; ?>" disabled>

                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <select class="form-control" name="gender" disabled><option disabled selected><?php echo $row[2]; ?></option></select>

                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="text" class="form-control" placeholder="DOB" aria-label="DOB" aria-describedby="basic-addon1" onfocus="(this.type='date')" onblur="(this.type='text')" name="dob" value="<?php echo $row[3]; ?>" disabled>

                        </div>
                       
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <textarea class="form-control" aria-label="With textarea" placeholder="Address" name="address" rows="4" disabled><?php echo $row[5]; ?></textarea>
                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="number" class="form-control" placeholder="Pincode" aria-label="Pincode" aria-describedby="basic-addon1" name="pincode" value="<?php echo $row[6]; ?>" disabled>

                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="text" class="form-control" placeholder="District" aria-label="District" aria-describedby="basic-addon1" name="district" value="<?php echo $row[7]; ?>" disabled>

                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="text" class="form-control" placeholder="State" aria-label="State" aria-describedby="basic-addon1" name="state" value="<?php echo $row[8]; ?>" disabled>

                        </div>
                        <div class="form-group has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                            <input type="text" class="form-control" placeholder="Country" aria-label="Country" aria-describedby="basic-addon1" name="country" value="<?php echo $row[9]; ?>" disabled>

                        </div>

                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <textarea class="form-control" aria-label="About youself" rows="8" placeholder="About yourself" name="about" disabled><?php echo $row[12]; ?></textarea>
                        </div>

                        <!-- <div class="" -->
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100 mx-auto w-100 align-items-center">
                        <a href="../php/block?rawvalue=<?php echo $val; ?>&id=<?php echo $row[0]; ?>&t=approvedusers" class="btn btn-danger w-100" onclick="return confirm('Block <?php echo $row[1]; ?>?')">Block</a>
                        </div>
                    
                    </div>
                </div>
            </div>
    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2 col-1"></div>


         </div>


         </div>
       </div>
    </div>

</body>
</html>

<?php
}else{
     echo "Something went wrong";             
}
}else{
  echo "Something went wrong";
}
}
        }
    }
}
?>