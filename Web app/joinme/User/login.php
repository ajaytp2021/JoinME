<?php session_start(); ob_start(); require '../php/server/server.php'; ?>
<!DOCTYPE html>
<html class="userbg h-100" lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="stylesheet" href="../css/parsley.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="https://parsleyjs.org/src/parsley.css"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>


<body class="userbg" style="background-image: url('../assets/images/icons/loadingbg.svg')">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col">
            </div>
            <div class="card d-inline-flex p-2 col-lg-5 col-md-5 col-sm-6 col-xl-4 col-9">
                <div class="card-body">
                    <div id="msg"></div>
                    <form method="POST" name="loginform" id="loginform" onsubmit="">
                        <p class="text-center font-weight-bold">User Login</p>

                        <div class="form-group has-error has-feedback">
                            <input type="text" id="uname" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="uname" data-parsley-pattern="ˆ[a-zA-Z]+$" data-parsley-trigger="keyup">

                        </div>

                        <div class="form-group">
                            <input type="password" id="pass" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="pass">
                        </div>

                        <div class="form-group form-row">
                        <img class="col-xl-6 col-lg-6 col-md-6 col-md-6 col-sm-6 col-6" src="../global/captcha.php.php?rand=<?php echo rand();?>" id="captchaimg">
                        <input class="col-xl-6 col-lg-6 col-md-6 col-md-6 col-sm-6 col-6 form-control" id="captcha_code" name="captcha_code" type="text" placeholder="Enter captcha here">
                        </div>

                        <div class="form-group">
                        <div class="col-xl-12 col-lg-12 col-md-12">Captcha error? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</div>
                        </div>

                        <!-- <div class="" -->
                        <center><input type="submit" name="loginAdmin" class="btn btn-primary" value="Login" /></center>
                        <div class="form-group m-3">
                        Don't have account? Click the <a href="<?php echo $host; ?>/User/register.php">Register</a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>


<script>
    function refreshCaptcha()
{
img = document.getElementById('captchaimg');
img.src = '../global/captcha.php';
}
//     bootstrapValidate(
//    '#uname',
//    'email:Enter a valid E-Mail Address!'
// );
refreshCaptcha()
bootstrapValidate(['#uname','#pass','#captcha_code'], 'required:Please fill out this field!');
// bootstrapValidate('#uname', 'regex:^[a-z]+$:Invalid format');



</script>
<!-- Script end -->

</html>






<?php
require '../php/con.php';
require '../global/global.php';
error_reporting(E_ALL);
$salt = "Joinme2020";
    if(isset($_POST['loginAdmin'])){
        if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
            echo wrongCaptcha();
            }else{

                $uname = mysqli_real_escape_string($con, $_POST['uname']);
                $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $q = "select * from login where uname='$uname' and type=2 LIMIT 1";
    $check = mysqli_query($con, $q);
    if($check){
    if(mysqli_num_rows($check) > 0){
        if($row = mysqli_fetch_array($check)){
            if($row[4] == 1){
            if(hash('gost', $pass.$salt) == $row[2]){
                $_SESSION["loginuser"] = hash('gost', $_SERVER['REMOTE_ADDR'].$salt);
                $_SESSION["uid"] = base64_encode($row[0]);
                $link = $host."/User/home.php?rawvalue=".hash('gost', $_SERVER['REMOTE_ADDR'].$salt);
                header('Location: '.$link);
            }else{
                echo wrongUnamePass();
            }
        }else if($row[4] == 2){
            echo adminAccBlocked();
        }else{
            echo adminNotVerified();
        }
        }else{
            echo wrongUnamePass();
        }
       

    }else{
       
        echo wrongUnamePass();
    }
    
}
            }
}

ob_end_flush();

?>