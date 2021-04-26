<?php
require '../../../php/con.php';
require '../../../php/server/server.php';
error_reporting(E_ALL);
$response = array();
$data = array();
$finalArray = array();
$EncodeData = file_get_contents('php://input');
$DecodeData = json_decode($EncodeData, true);
$min = 3;
        $id = $DecodeData['uid'];
        $page = $DecodeData['page'];
          $jobreq = "select jobApply.*, posts.*, company.cname, (select count(*) from usersOnProject where usersOnProject.CPId=jobApply.PId and usersOnProject.UId=".base64_decode($id).") as counts from jobApply inner join posts on jobApply.PId=posts.PId inner join company on company.CId=jobApply.CId where jobApply.UId=".base64_decode($id)." order by jobApply.applyDateTime desc";
          $count = mysqli_num_rows(mysqli_query($con, $jobreq));
            if($res = mysqli_query($con, $jobreq)){
$nr = mysqli_num_rows($res);
if($nr != 0){
  while($row = mysqli_fetch_array($res)){
      $data['cid'] = $row['CId'];
      $data['pid'] = $row['PId'];
      $data['ptitle'] = $row['pTitle'];
      $data['cname'] = $row['cname'];
      $data['desc'] = $row['descr'];
      $data['nousers'] = $row['NoUsers'];
      $data['ulevel'] = $row['Ulevel'];
      $data['jtitle'] = $row['jTitle'];
      $data['salary'] = $row['salary'];
      $data['reqdate'] = date_format(date_create($row['applyDateTime']), 'D M Y');
      $data['postdate'] = date_format(date_create($row['pDate']), 'D M Y');
      $data['count'] = $row['counts'];

      array_push($finalArray, $data);
  }
  $response = array('status' => 200,
  'msg' => 'Data found',
  'data' => $finalArray, 
  'page' => $page + $min, 
  'totalcount' => $count, 
  'currentcount' => $nr, 
  'mincount' => $min
);

}else{ 
    $response = array('status' => 204,
    'msg' => 'No data found',
    'data' => null
  );
}

            }else{
                $response = array('status' => 204,
  'msg' => mysqli_error($con)
);
            }

echo json_encode($response);
?>