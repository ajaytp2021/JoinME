<?php
//Encryption salt
require '../php/con.php';
require '../php/server/server.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


//login.php error msg
function wrongUnamePass(){
    return "<script>
    if(typeof(document.getElementById('alt')) == 'undefined' || document.getElementById('alt') == null){
       var iDiv = document.createElement('div');
   iDiv.id = 'alt';
   iDiv.className = 'alert alert-danger text-center';
   iDiv.innerHTML += 'Username or password is incorrect.';
   document.getElementById('msg').appendChild(iDiv);
   }
   </script>";
}

function adminNotVerified(){
    return "<script>
    if(typeof(document.getElementById('alt')) == 'undefined' || document.getElementById('alt') == null){
       var iDiv = document.createElement('div');
   iDiv.id = 'alt';
   iDiv.className = 'alert alert-danger text-center';
   iDiv.innerHTML += 'Your account have not been approved';
   document.getElementById('msg').appendChild(iDiv);
   }
   </script>";
}

function adminAccBlocked(){
    return "<script>
    if(typeof(document.getElementById('alt')) == 'undefined' || document.getElementById('alt') == null){
       var iDiv = document.createElement('div');
   iDiv.id = 'alt';
   iDiv.className = 'alert alert-danger text-center';
   iDiv.innerHTML += 'Your account have been blocked';
   document.getElementById('msg').appendChild(iDiv);
   }
   </script>";
}

function wrongCaptcha(){
    return "<script>
    if(typeof(document.getElementById('alt')) == 'undefined' || document.getElementById('alt') == null){
       var iDiv = document.createElement('div');
   iDiv.id = 'alt';
   iDiv.className = 'alert alert-danger text-center';
   iDiv.innerHTML += 'Wrong captcha entered';
   document.getElementById('msg').appendChild(iDiv);
   }
   </script>";
}

function alert($msg){
    return '<script>window.alert('.$msg.')</script>';
}





function checkExistAcc($con, $uname){
    $q = "select * from login where uname='$uname'";
    $res = mysqli_query($con,$q);

    return mysqli_num_rows($res);
}

function checkExistPhoneEmail($con, $phone, $email){
    $q = "select * from address where phone='$phone' or email='$email'";
    $res = mysqli_query($con,$q);

    return mysqli_num_rows($res);
}

function insLogin($con, $uname, $pass, $type, $approve){
    $salt = "Joinme2020";
    $encPass = hash('gost', $pass.$salt);
    $insertLogin = "insert into login (`uname`, `pass`, `type`, `approve`) values ('$uname', '$encPass', $type, $approve)";
    return mysqli_query($con,$insertLogin);
}

function insUser($con, $name, $gender, $dob, $id){
   
    $insertUser = "insert into users values ($id, '$name', '$gender', '$dob')";
    return mysqli_query($con,$insertUser);
}

function insCompany($con, $cname, $csdate, $id){
   
    $insertCompany = "insert into company values ($id, '$cname', '$csdate')";
    return mysqli_query($con,$insertCompany);
}

function insAddress($con, $addr, $pincode, $district, $state, $country, $email, $phone, $about, $img, $id){
    
    $insertAddress = "insert into address values ($id, '$addr', $pincode, '$district', '$state', '$country', '$email', '$phone', '$about', '$img')";
    return mysqli_query($con,$insertAddress);
}

function uploadProfilePic($con, $img, $imgloc){

    if(!empty($img) || $img != null || !empty($imgloc) || $imgloc != null){
  $path = $_SERVER['DOCUMENT_ROOT']."/assets/images/profile_pic/";
  $fullpath = $path.$img;
       
  if(move_uploaded_file($imgloc, $fullpath)){
      
      return true;
      
  }else{
    return false;

  }
}else{
    return true;
}      
 
}

function pageBack($pagenum){
    return $pagenum-1;
  }
  function pageForward($pagenum){
    return $pagenum+1;
  }

function isPrjStart($con, $postId, $cid){
    $check = "select * from companyProjects where CPId=$postId and CId=$cid";
         if($r = mysqli_query($con, $check)){
           if(mysqli_num_rows($r) != 0){
           if($rw = mysqli_fetch_array($r)){
             if($rw['status'] > 0){
               return true;
             }else{
               return false;
             }
           }
          }else{
            return false;
          }
         }else{
           return false;
         }
}

function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomStringDocs($length = 50) {
    $charactersDocs = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLengthDocs = strlen($charactersDocs);
    $randomStringDocs = '';
    for ($i = 0; $i < $length; $i++) {
        $randomStringDocs .= $charactersDocs[rand(0, $charactersLengthDocs - 1)];
    }
    return $randomStringDocs;
}

function uploadPdfDoc($con, $pdf, $pdfloc){

    if(!empty($pdf) || $pdf != null || !empty($pdfloc) || $pdfloc != null){
  $path = $_SERVER['DOCUMENT_ROOT']."/assets/users/docs/files/";
  $fullpath = $path.$pdf;
       
  if(move_uploaded_file($pdfloc, $fullpath)){
      
      return true;
      
  }else{
    return false;

  }
}else{
    echo 'no data';
    return true;
}      
 
}

function countUsers($con){
$select = "select * from login where type=2 and approve=1";
if($r = mysqli_query($con, $select)){
    $c = mysqli_num_rows($r);
    return $c;
}
}

function countCompanies($con){
    $select = "select * from login where type=1 and approve=1";
    if($r = mysqli_query($con, $select)){
        $c = mysqli_num_rows($r);
        return $c;
    }
}

function newReqUsers($con){
    $select = "select * from login where type=2 and approve=0";
    if($r = mysqli_query($con, $select)){
        $c = mysqli_num_rows($r);
        return $c;
    }
}

function newReqCompanies($con){
    $select = "select company.cname from ((company inner join address on company.CId=address.CUId inner join login on company.CId=login.Lid and login.approve=0))";
    if($r = mysqli_query($con, $select)){
        $c = mysqli_num_rows($r);
        return $c;
    }
}


?>