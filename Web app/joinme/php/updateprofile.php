<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);
$val;
if(isset($_POST["updatecompany"])){
    $val = $_SESSION['logincompany'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $csdate = $_POST['csdate'];
    $pincode = $_POST['pincode'];
    $addr = $_POST['address'];
    $dist = $_POST['district'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $about = mysqli_real_escape_string($con, $_POST['about']);
    $id = base64_decode($_POST["hidden"]);
    if($con){
        $updatecompany = "update company set since='$csdate' where CId=$id";
        $updatedetails = "update address set address='$addr', pincode=$pincode, district='$dist', state='$state', country='$country', email='$email', phone='$phone', about='$about' where CUId=$id";
        if(mysqli_query($con, $updatecompany)){
            if(mysqli_query($con, $updatedetails)){
                $id = base64_encode($id);
                echo '<script>
                window.alert("Profile updated")
                window.location.href="'.$host.'/Company/profile.php?rawvalue='.$val.'";
                </script>
                ';
            }else{
            echo mysqli_error($con);
            }
        }else{
            echo mysqli_error($con);
        }
    }
}
if(isset($_POST["updateuser"])){
    $val = $_SESSION['loginuser'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pincode = $_POST['pincode'];
    $addr = $_POST['address'];
    $dist = $_POST['district'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $about = mysqli_real_escape_string($con, $_POST['about']);
    $id = base64_decode($_POST["hidden"]);
    if($con){
        $updatedetails = "update address set address='$addr', pincode=$pincode, district='$dist', state='$state', country='$country', email='$email', phone='$phone', about='$about' where CUId=$id";
            if(mysqli_query($con, $updatedetails)){
                $id = base64_encode($id);
                echo '<script>
                window.alert("Profile updated")
                window.location.href="'.$host.'/User/profile.php?rawvalue='.$val.'";
                </script>
                ';
            }else{
            echo mysqli_error($con);
            }
    }
}

?>