<?php session_start(); ob_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>


<body style="background-image: url('../assets/images/icons/loadingbg.svg')">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col">
            </div>
            <div class="card d-inline-flex p-2 col-lg-5 col-md-5 col-sm-6 col-xl-4 col-9">
                <div class="card-body">
                    <div id="msg"></div>
                    <form method="POST" name="loginform" onsubmit="return loginCheck();" class="mx-auto">
                        <p class="text-center font-weight-bold">Admin Login</p>

                        <div class="form-group has-error has-feedback">
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="uname" id="uname">

                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="pass" id="pass">
                        </div>

                        <div class="form-group form-row">
                        <img class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6" src="../global/captcha.php?rand=<?php echo rand();?>" id="captchaimg">
                        <input class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-control" id="captcha_code" name="captcha_code" type="text" placeholder="Enter captcha here">
                        </div>

                        <div class="form-group">
                        <div class="col-xl-12 col-lg-12 col-md-12">Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</div>
                        </div>


                        

                        <!-- <div class="" -->
                        <center><input type="submit" name="loginAdmin" class="btn btn-primary" value="Login" /></center>

                    </form>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

<!--   Scripting side    -->

<script type="text/javascript">

function refreshCaptcha()
{
img = document.getElementById('captchaimg');
img.src = '../global/captcha.php';
}

    function loginCheck() {
        var username = document.forms["loginform"]["uname"].value;
        var password = document.forms["loginform"]["pass"].value;
        document.forms["loginform"]["pass"].onkeyup = false;
        var val=0;
        if (username == "" && password == "") {
            // window.alert('Enter username');
            val = 1;
            if(typeof(document.getElementById("alt")) == 'undefined' || document.getElementById("alt") == null || val == 1){
                document.getElementById("msg").innerHTML = "";
            document.getElementById("msg").innerHTML += "<div class='alert alert-danger' id='alt'>All fields are required</div>";
            }
            return false;
        }else if(username == ""){
            val = 2;
            if(typeof(document.getElementById("alt")) == 'undefined' || document.getElementById("alt") == null || val == 2){
                document.getElementById("msg").innerHTML = "";
            document.getElementById("msg").innerHTML += "<div class='alert alert-danger' id='alt'>Username is required</div>";
            }
            return false;
        }else if(password == ""){
            val = 3;
            if(typeof(document.getElementById("alt")) == 'undefined' || document.getElementById("alt") == null || val == 3){
                document.getElementById("msg").innerHTML = "";
            document.getElementById("msg").innerHTML += "<div class='alert alert-danger' id='alt'>Password is required</div>";
            }
            return false;
        }else{
            return true;
        }
    }
</script>
<!-- Script end -->

</html>






<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
error_reporting(E_ALL);
$salt = "Joinme2020";
    if(isset($_POST['loginAdmin'])){
        if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
            echo wrongCaptcha();
            }else{

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $q = "select * from login where uname='$uname' and type=0 LIMIT 1";
    $check = mysqli_query($con, $q);
    if($check){
    if(mysqli_num_rows($check) > 0){
        if($row = mysqli_fetch_array($check)){
            if(hash('gost', $pass.$salt) == $row[2]){
                $sal = "Joinme2020";
                $_SESSION["login"] = hash('gost', $_SERVER['REMOTE_ADDR'].$sal);
                $_SESSION['sidebar'] = "";
                $link = $host."/joinme/Admin/dashboard?rawvalue=".hash('gost', $_SERVER['REMOTE_ADDR'].$sal);
                header('Location: '.$link);
            }else{
                echo wrongUnamePass();
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