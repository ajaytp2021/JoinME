<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "currentwork";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $showpagecount = 6;
          if(!isset($_GET['page'])){
            $page = 1;
          }else{
            $page = $_GET['page'];
          }
          $pid = 0;
          $curworks = "select distinct jobApply.*, posts.*, company.*, (select status from companyProjects where companyProjects.CPId=(select CPId from usersOnProject where UId=".base64_decode($id)." and status=1)) as status from jobApply inner join company on company.CId=jobApply.CId inner join usersOnProject on usersOnProject.UId=jobApply.UId inner join posts on posts.PId=(select CPId from usersOnProject where UId=".base64_decode($id)." and status=1) where jobApply.UId=".base64_decode($id)." LIMIT 1";
          if($res = mysqli_query($con, $curworks)){

        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
<script src="../js/jquery.js"></script>    
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/circlepulsing.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="../js/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,'users', $id); ?></title>
</head>

<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    JoinME Home
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
      <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left">
       <div class="container-fluid row h-100 text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">MY CURRENT WORK</li>
  </ol>
</nav>
<div class="w-100"><a href="completedprojects?rawvalue=<?php echo $val; ?>" class="float-right m-2 small">View completed projects</a></div>
</div>
<?php
if(mysqli_num_rows($res) != 0){
  $row = mysqli_fetch_array($res);
  $pid = $row['PId'];
  $reports = "select * from dailyWorkReport where CPId=$pid and UId=".base64_decode($id)." order by uDate desc";
  $dates = "select distinct uDate from dailyWorkReport where CPId=$pid and UId=".base64_decode($id);
  if($countres = mysqli_query($con, $reports)){
    $totalcount = mysqli_num_rows($countres);
    $currentpagecount = ceil($totalcount / $showpagecount);
    $this_page_first_result = (($page - 1) * $showpagecount);
    $reports = $reports." LIMIT ".$this_page_first_result.", ".$showpagecount;

  }
  if($row['status'] != 2){
  ?>
<ul class="list-group pl-3 card card-body border-success col-xl-12 col-lg-12 col-md-12 mb-3">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-10 col-lg-10 col-md-10 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo $row[6]; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12"><?php echo $row['jTitle']." - ".$row['Ulevel']; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo "Company : ".$row['cname']; ?></small>
            </div>
            </div>
              <div class="col-xl-2 col-lg-2 col-md-2 mr-3 row">
              <small class="align-bottom font-weight-bold w-100 float-right col-xl-12 col-lg-12 col-md-12 m-0 p-0 align-bottom align-text-bottom rounded text-white text-uppercase"><p class="rounded text-white p-1 <?php if($row['status'] == null){ echo 'bg-warning'; }else if($row['status'] == 1){ echo 'bg-success'; } ?>" style="background-image: url(<?php if($row['status'] == 1){ echo '../assets/images/icons/loadingbtn.svg'; } ?>)"><?php if($row['status'] == null){ echo 'Not started'; }else{ echo 'In progress'; } ?></p></small>
             </div>
            </li>
            <div class="w-100">
            <button class="btn btn-primary mt-3 w-auto" <?php if($row['status'] == 1){ ?>onclick="openUploadReports();"<?php }else{ ?>onclick="javascript: alert('This project not yet started');"<?php } ?>>Upload work report</button>
            </div>
          </ul>
          <?php if($row['status'] == 1){ ?>
          <div class="modal shadow-lg" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="reportmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="reportmodalLabel">Enter git details</h5>
        <button type="button" id="modalclose" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" >Git Push ID</span>
  </div>
  <input type="text" class="form-control" placeholder="Enter here" id="gitid" aria-label="Enter here" maxlength="7" aria-describedby="basic-addon1">
</div>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Description</span>
  </div>
  <textarea class="form-control" placeholder="Enter here" aria-label="With textarea" id="desc"></textarea>
</div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" id="updaterep" class="btn btn-success">Update report</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
          <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0" id="cwr">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">MY CURRENT WORK REPORTS</li>
  </ol>
</nav>
</div>
<?php
$res = mysqli_query($con, $reports);
$nr = mysqli_num_rows($res);
if($nr != 0){
  $count = mysqli_num_rows($res);
  $i = 0;
  $r = mysqli_query($con, $dates);
  $arr = array();
  while($daterow = mysqli_fetch_array($r)){
    array_push($arr, $daterow['uDate']);
  }
  $tmpArray=array();
  while($row = mysqli_fetch_array($res)){
   
?>
<div class="list-group pl-3 card col-xl-12 col-lg-12 col-md-12 border-bottom-0 border-top-0 mr-0">
            <div class="w-100 row">
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 mr-3 h-100 d-flex flex-column pr-0">
            <div style="height:100%">
            <?php if(in_array($row['uDate'], $arr)){
              $tmpLength=0;
              $_key=str_replace('-','_',$row['uDate']);
              $_value=array_key_exists($_key,$tmpArray)?$tmpArray[$_key]=1:$tmpLength;
              $tmpArray=array($_key=> $_value);
             if($tmpArray[$_key] == 0){ ?>
             <div class="makeCenter ">
                   <div class="circle"></div> 
                </div>
                <div class="makeCenter" style="height:100%; margin-bottom: 15px;">
                  <div class="vl"></div>
                </div>
             
             <?php }else{ ?>
              <div class="makeCenter" style="height:100%; padding-bottom: 2px;">
                  <div class="vl-dashed"></div>
                </div>


             <?php }
            } ?>
            </div>


             </div>
            <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 row justify-content-center p-3">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 p-0 text-left">
            <h6 class="text-secondary text-left font-weight-bold w-100 m-0 col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo "Git ID : ".$row['gitid']; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12"><?php echo "Changes : ".$row['desc']; ?></small>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-right align-self-center">
            <?php if($tmpArray[$_key] == 0){ ?>
            <p class="small bg-primary float-right text-white pl-2 pr-2 mb-0" style="width: fit-content; border-radius: 10px"><?php echo date("d-m-Y",strtotime($row['uDate'])); ?></p>
            <?php } ?>
            </div>
            </div>
            </div>
          </div>
          <?php if($count != $i){ ?>
            <hr class="w-100 m-0">
          <?php } ?>
          
       <?php } ?>
       <?php if($nr != 0){ ?>
<nav aria-label="...">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="currentwork?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>#cwr" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="currentwork?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>#cwr" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="currentwork?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>#cwr" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
<?php } ?>
      <?php }else{ ?>
            <div class="w-100 h-auto">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No current work reports</p>
</div>
          <?php } }else{ ?>
            <div class="w-100 h-auto">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No current work</p>
</div>
          <?php } }else{ ?>
            <div class="w-100 h-auto">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No current work</p>
</div>
         <?php } ?>
         </div>
       </div>
    </div>
<script>
function openUploadReports(){
$('#reportmodal').show();
}
$('#modalclose').on("click", function(){
$('#reportmodal').hide();
});

$('#updaterep').on("click", function(){
  var gitid = prompt("Double check your GIT ID.\nYou can't edit or delete after done it.", $('#gitid').val())
  if(gitid != null){
  $.ajax({
        url: "../php/updatereport?rawvalue=<?php echo $val; ?>&pid=<?php echo base64_encode($pid); ?>&uid=<?php echo $id; ?>&code="+btoa(gitid)+"&desc="+btoa($('#desc').val()),
        type: 'GET',
        dataType: 'JSON',
         error: function (xhr, ajaxOptions, thrownError) {
    alert(xhr.status);
    alert(thrownError);
  },
  success: function(res){
    if(res[0]['res'] == "success"){
      swal("Successfull!", "Report updated!", "success").then(function(){
        window.location.reload();
      });
$('#reportmodal').hide();
    }else{
      alert(res[0]['msg']);
    }
    
  }
    });
  }
})
</script>
</body>
</html>

<?php
          }
        }
    }
}
?>