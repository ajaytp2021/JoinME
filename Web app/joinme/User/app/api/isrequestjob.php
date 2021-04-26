<?php
require '../../../php/server/server.php';
require '../../../php/con.php';
// require '../../../global/global.php';
error_reporting(E_ALL);
          
          $isReq = false;
          $onPrj = false;
          $response = array();
$EncodeData = file_get_contents('php://input');
$DecodeData = json_decode($EncodeData, true);
$postid = $DecodeData['pid'];
$cid = $DecodeData['cid'];
$id = $DecodeData['uid'];
$check = "select status from usersOnProject where UId=".base64_decode($id);
$checkreq = "select * from jobApply where UId=".base64_decode($id)." and PId=".$postid." and CId=".$cid;
$status = 200;
if($r = mysqli_query($con, $check)){
              $row = mysqli_fetch_array($r);
              if(isset($row['status'])){
                if($row['status'] === 0){
                  $onPrj = false;
            }else{
              $onPrj = true;
            }
            $status = 200;
              }else{
                $onPrj = false;
                $status = 200;
              }

              if($res = mysqli_query($con, $checkreq)){
                if(mysqli_num_rows($res) == 0){
                  $isReq = false;
                }else{
                  $isReq = true;
                }
                $status = 200;
              }else{
                $status = 204;
              }
              
          $response = array('msg' => 'Data found',
    'status' => $status,
    'isReq' => $isReq,
    'onPrj' => $onPrj
  );
        }else{
          $response = array('msg' => 'Query error',
    'status' => 204,
    'data' => mysqli_error($con)
  );
        }


echo json_encode($response);

?>
