<?php
require '../php/con.php';
require '../global/global.php';
require 'server/server.php';
if(isset($_POST['registerCompany'])){

    if($con){
    $uname = $_POST['uname'];
    $cname = $_POST['cname'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $csdate = $_POST['csdate'];
    $pincode = $_POST['pincode'];
    $addr = $_POST['address'];
    $dist = $_POST['district'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $about = $_POST['about'];
    $img = "";
    $imgloc = "";
    if(!empty($_FILES) && isset($_FILES['img'])){
        $img = $_FILES['img']['name'];
        $imgloc = $_FILES['img']['tmp_name'];
    }


    if(checkExistAcc($con, $uname) == 0 ){
        if(checkExistPhoneEmail($con, $phone, $email) < 1){
                $imgloc != "" ? uploadProfilePic($con, $img, $imgloc) : null;
            if(insLogin($con, $uname, $pass, 1, 0)){
                $id = mysqli_insert_id($con);
                if(insCompany($con, $cname, $csdate, $id)){
                    if(insAddress($con, $addr, $pincode, $dist, $state, $country, $email, $phone, $about, $img, $id)){
                        echo '<script>
                        window.alert("Successfully Registered");
                        window.location.replace("'.$host.'/Company/login.php");
                        </script>';
                        

                    }else{
                        echo mysqli_error($con);
                    }
                }else{
                    echo mysqli_error($con);
                }
            }else{
                echo mysqli_error($con);
            }
        
   
            }else{
                echo '<script>
                window.alert("Email or Phone number is already used");
                window.location.replace("'.$host.'/Company/register")
                </script>';
        }
    }else{
        echo '<script>
        window.alert("This Username has already taken");
        window.location.replace("'.$host.'/Company/register")
        </script>';
        
    }

    }else{
        alert(mysqli_connect_error);
    }
}else if(isset($_POST['registerUser'])){

    if($con){
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $pincode = $_POST['pincode'];
    $addr = $_POST['address'];
    $dist = $_POST['district'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $about = $_POST['about'];
    $img = "";
    $imgloc = "";
    if(!empty($_FILES) || isset($_FILES['img'])){
        $img = $_FILES['img']['name'];
        $randimg = generateRandomString().".png";
        $imgloc = $_FILES['img']['tmp_name'];
    }
    


    if(checkExistAcc($con, $uname) == 0 ){
        if(checkExistPhoneEmail($con, $phone, $email) < 1){
                $imgloc != "" ? uploadProfilePic($con, $randimg, $imgloc) : null;
            if(insLogin($con, $uname, $pass, 2, 0)){
                $id = mysqli_insert_id($con);
                if(insUser($con, $name, $gender, $dob, $id)){
                    if(insAddress($con, $addr, $pincode, $dist, $state, $country, $email, $phone, $about, $randimg, $id)){
                        echo '<script>
                        window.alert("Successfully Registered");
                        window.location.replace("'.$host.'/User/login.php");
                        </script>';
                        

                    }else{
                        echo mysqli_error($con);
                    }
                }else{
                    echo mysqli_error($con);
                }
            }else{
                echo mysqli_error($con);
            }
   
            }else{
                echo '<script>
                window.alert("Email or Phone number is already used");
                window.location.replace("'.$host.'/User/register.php")
                </script>';
        }
    }else{
        echo '<script>
        window.alert("This Username has already taken");
        window.location.replace("'.$host.'/User/register.php")
        </script>';
        
    }

    }else{
        alert(mysqli_connect_error);
    }
}else{
    header('WWW-Authenticate: Negotiate');
}


?>