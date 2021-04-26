<?php
require '../../../php/server/server.php';
require '../../../php/con.php';
// require '../../../global/global.php';
error_reporting(E_ALL);
$response = array();
$data = array();
$finalArray = array();
$skillsArray = array();
$EncodeData = file_get_contents('php://input');
$DecodeData = json_decode($EncodeData, true);
$min = 3;
    $id = $DecodeData['uid'];
    $page = $DecodeData['page'];
    $skills = "select DISTINCT(skills.skill) from userSkill inner join skills on userSkill.SKId=skills.SKId where userSkill.UId=".base64_decode($id);
          if($res = mysqli_query($con, $skills)){
            if(mysqli_num_rows($res) != 0){
              $posts = "select DISTINCT(ps.PId) as checkid, ps.*, cm.cname from posts ps left join prjSkills prj on ps.PId=prj.PId left join company cm on ps.CId=cm.CId where prj.skill in (select skills.skill from skills inner join userSkill on skills.SKId=userSkill.SKId where userSkill.UId=".base64_decode($id).") and ps.EDate >= '".date('Y-m-d')."' order by ps.pDate desc, ps.EDate asc";
            }else{
              $posts = "select DISTINCT(ps.PId) as checkid, ps.*, cm.cname from posts ps left join prjSkills prj on ps.PId=prj.PId left join company cm on ps.CId=cm.CId where ps.EDate >= '".date('Y-m-d')."' order by ps.pDate desc, ps.EDate asc";
            }
          }
          $count = mysqli_num_rows(mysqli_query($con, $posts));
          $posts = $posts." LIMIT ".$page.", ".$min;
    if($res = mysqli_query($con, $posts)){
        $nr = mysqli_num_rows($res);
  if($nr != 0){
    $i = 0;
    while($row = mysqli_fetch_array($res)){
      
          $data['cid'] = $row['CId'];
          $data['pid'] = $row['PId'];
          $data['ptitle'] = $row['pTitle'];
          $data['cname'] = $row['cname'];
          $data['desc'] = $row['descr'];
          $data['edate'] = $row['EDate'];
          $data['pdate'] = $row['pDate'];
          $fetchSkills = "select skill, NoUsers as no from prjSkills where PId=".$row['PId']." and CId=".$row['CId'];
          if($r = mysqli_query($con, $fetchSkills)){
            $skillsArray = array();
            while($rows = mysqli_fetch_array($r)){
              array_push($skillsArray, $rows['skill']);
            }
            
          }
          $data['skills'] = $skillsArray;

        array_push($finalArray, $data);
    }
    $response = array('msg' => 'success',
                'status' => 200, 'data' => $finalArray, 'page' => $page + $min, 'totalcount' => $count, 'currentcount' => $nr, 'mincount' => $min, 'today' => date('Y-m-d'));
}else{
    $response = array('msg' => 'No data',
    'status' => 204, 'page' => 0, 'totalcount' => $count, 'currentcount' => $nr);
}
    }else{
    $response = array('msg' => 'Query error',
                'status' => 400, 'data' => $posts, 'page' => 0, 'totalcount' => 0, 'currentcount' => 0);
}

echo json_encode($response);

?>