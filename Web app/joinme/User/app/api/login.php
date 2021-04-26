<?php
require '../../../php/server/server.php';
require '../../../php/con.php';
// require '../../../global/global.php';
error_reporting(E_ALL);
$salt = "Joinme2020";
$response = array();
$EncodeData = file_get_contents('php://input');
$DecodeData = json_decode($EncodeData, true);

                $uname = $DecodeData['uname'];
                $pass = $DecodeData['pass'];
    $q = "select * from login where uname='$uname' and type=2 LIMIT 1";
    $check = mysqli_query($con, $q);
    if($check){
    if(mysqli_num_rows($check) > 0){
        if($row = mysqli_fetch_array($check)){
            if($row[4] == 1){
            if(hash('gost', $pass.$salt) == $row[2]){
                $response = array('msg' => 'success',
                'status' => 200,
                'data' => array(
                    'uid' => base64_encode($row[0])
                ));
            }else{
                $response = array('msg' => 'Username or password is incorrect',
                'status' => 400);
            }
        }else if($row[4] == 2){
            $response = array('msg' => 'Administaration has blocked your account',
                'status' => 400);
        }else{
            $response = array('msg' => 'Your account has not verified yet',
                'status' => 400);
        }
        }else{
            $response = array('msg' => 'Username or password is incorrect',
                'status' => 400);
        }
       

    }else{
       
        $response = array('msg' => 'Username or password is incorrect',
                'status' => 400);
    }
}else{
    $response = array('msg' => 'Query error',
                'status' => 400);
}

echo json_encode($response);

?>