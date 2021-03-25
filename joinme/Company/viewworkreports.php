<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
ob_start();
session_start();
error_reporting(E_ALL);
$_SESSION['sidebarc'] = "postjob";
    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $showpagecount = 6;
          if(!isset($_GET['page'])){
            $page = 1;
          }else{
            $page = $_GET['page'];
          }
          $i = 0;
          $uname = $_GET['uname'];
          $id = base64_decode($id);
          $uid = $_GET['uid'];
          $postId = $_GET['pid'];
          $ptitle = $_GET['ptitle'];
          $reports = "select * from dailyWorkReport where CPId=".base64_decode($postId)." and UId=".base64_decode($uid)." order by uDate desc";
          $dates = "select distinct uDate from dailyWorkReport where CPId=".base64_decode($postId)." and UId=".base64_decode($uid);
          if($countres = mysqli_query($con, $reports)){
            $totalcount = mysqli_num_rows($countres);
            $currentpagecount = ceil($totalcount / $showpagecount);
            $this_page_first_result = (($page - 1) * $showpagecount);
            $reports = $reports." LIMIT ".$this_page_first_result.", ".$showpagecount;
  
          }
?>

<!DOCTYPE html>
<html lang="en">

<head>

<script src="../js/jquery.js"></script>    
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/circlepulsing.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php getName($con,'company', base64_encode($id)); ?></title>
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
       <div class="container-fluid row h-auto text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="postjob?rawvalue=<?php echo $val; ?>#<?php echo $postId; ?>">OUR POST LIST</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="uop?rawvalue=<?php echo $val; ?>&ptitle=<?php echo $ptitle; ?>&pid=<?php echo $postId; ?>">USERS ON PROJECT</a></li>
    <li class="breadcrumb-item active" aria-current="page">WORK REPORTS</li>
  </ol>
</nav>
</div>
<div class="w-100">
<p class="text-uppercase float-left text-primary font-weight-bold ml-3"><?php echo base64_decode($uname)."'s"; ?> WORK REPORTS</p>
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
<nav aria-label="..." class="mt-3">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="viewworkreports?rawvalue=<?php echo $val; ?>&uid=<?php echo $uid; ?>&pid=<?php echo $postId; ?>&uname=<?php echo $uname; ?>&ptitle=<?php echo $ptitle; ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="viewworkreports?rawvalue=<?php echo $val; ?>&uid=<?php echo $uid; ?>&pid=<?php echo $postId; ?>&uname=<?php echo $uname; ?>&ptitle=<?php echo $ptitle; ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="viewworkreports?rawvalue=<?php echo $val; ?>&uid=<?php echo $uid; ?>&pid=<?php echo $postId; ?>&uname=<?php echo $uname; ?>&ptitle=<?php echo $ptitle; ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
<?php } ?>
      <?php }else{ ?>
            <div class="w-100 h-auto">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No current work reports</p>
</div>
<?php } ?>
          
       </div>
      

         </div>
       </div>
    </div>
   <script>
        var val = [];
  //  $('$save').prop('disabled', true);
  //  $('[type=checkbox]').on("change", function(){
  //    if(val.length > 0){
  //  $('$save').prop('disabled', false);
  //    }else{
  //  $('$save').prop('disabled', true);
  //    }
  //  })
   $(function(){
      $('#save').click(function(){
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        if(val.length == 0){
          alert('No user(s) you have selected');
        }else{
          var dval = [];
          for(var i = 0; i < val.length; i++){
            dval[i] = atob(val[i]);
          }
          $.ajax({
        url: "../php/deleteuop?rawvalue=<?php echo $val; ?>&arr="+dval,
        type: 'GET',
        dataType: 'JSON',
         error: function (xhr, ajaxOptions, thrownError) {
    alert(xhr.status);
    alert(thrownError);
  },
  success: function(res){
    if(res[0]['res'] == "success"){
      alert('Successfully delete from this project');
      window.location.reload();
    }else{
      alert('Error on deleting');
    }
    
  }
    });
        }
      });
    });
   </script>
</body>
</html>

<?php
        }
    }
}
ob_end_flush();
?>