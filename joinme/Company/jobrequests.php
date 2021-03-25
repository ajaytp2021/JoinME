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
          $ptitle = base64_decode($_GET['ptitle']);
          $id = base64_decode($id);
          $postId = base64_decode($_GET['pid']);
          $num = "select NoUsers from posts where PId=$postId";
          if($result = mysqli_query($con, $num)){
            $nouser = mysqli_fetch_array($result)['NoUsers'];
          }
         $requsers = "select DISTINCT jobApply.*, users.*, address.*, (select round(avg(rating.rating),1) from rating where rating.RRId=jobApply.UId) as ratings, (select usersDocument.path from usersDocument where usersDocument.UId=jobApply.UId and usersDocument.type='cv') as path from jobApply inner join users on users.UId=jobApply.UId inner join address on address.CUId=jobApply.UId where jobApply.CId=$id and jobApply.PId=$postId order by ratings desc, (select count(*) from rating where rating.RSId=jobApply.UId) desc";
         $isstart = isPrjStart($con, $postId, $id);
         if($countres = mysqli_query($con, $requsers)){
          $totalcount = mysqli_num_rows($countres);
          $currentpagecount = ceil($totalcount / $showpagecount);
          $this_page_first_result = (($page - 1) * $showpagecount);
          $requsers = $requsers." LIMIT ".$this_page_first_result.", ".$showpagecount;

        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<script src="../js/jquery.js"></script>    
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
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
    <li class="breadcrumb-item" aria-current="page"><a href="postjob?rawvalue=<?php echo $val; ?>#<?php echo base64_encode($postId); ?>">OUR POST LIST</a></li>
    <li class="breadcrumb-item active" aria-current="page">JOB REQUESTS</li>
  </ol>
</nav>
</div>
<div class="col-xl-12 col-lg-12 col-md-12 mb-3 font-weight-bold text-left text-primary text-uppercase"><?php echo $ptitle; ?>
</div>

<?php
        if($res = mysqli_query($con, $requsers))
        {
          $no = 0;
          $nr = mysqli_num_rows($res);
          if($nr > 0){
            $rev = array();
            $count = 0;
          while($row = mysqli_fetch_array($res)){
        ?>
       
        <ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3 hvr-overline-reveal">
            <li class="d-flex align-content-center">
<?php if(!$isstart){ ?><a href="../php/addutop?rawvalue=<?php echo $val; ?>&data=<?php echo base64_encode($row['UId']); ?>&pid=<?php echo base64_encode($postId); ?>" id="save" class="border-0 bg-transparent align-self-center mr-2" style="cursor: pointer;" name="save" onclick="return confirm('Do you want to add this user?')" value="<?php echo base64_encode($row['UId']); ?>"><img src="../assets/images/icons/plusblue.svg" class="fa fas-plus"></i></a><?php } ?>

            <img src="<?php echo $host.'/joinme/assets/images/profile_pic/'.$row['img']; ?>" class="img-fluid mr-3" style="clip-path: circle(50% at 50% 50%);" width="100px" alt="profile pic" onerror="this.onerror=null; this.src='../assets/images/icons/nobody.jpg'"></img>
            <div class="w-100 row">
            <div class="col-xl-8 col-lg-8 col-md-8 mr-3">
            <h6 class="text-secondary text-left font-weight-bold text-uppercase"><?php echo $row['name']; ?></h6>
            <small class="text-secondary float-left text-left w-100">Email : <?php echo $row['email']; ?></small>
            <small class="text-secondary float-left text-left w-100">Phone : <?php echo $row['phone']; ?></small>
            <?php if($row['path'] != null){ ?>
      <a href="../php/viewdoc?filename=<?php echo base64_encode($row['path']); ?>" class="float-left small card pl-2 pr-2 text-decoration-none" target="_blank">View CV</a>
      <?php }else{ ?>
      <p class="float-left small card pl-2 pr-2 text-secondary">No CV updated</p>
      <?php } ?>
            </div>
            </div>
              <div class="row justify-content-center mr-3">
        <?php if($row['ratings'] != null){ ?><div class="text-white text-center rounded font-weight-bold pl-1 pr-1 float-right align-self-center w-100" style="height: fit-content; background-color: <?php if($row['ratings'] >= 3){ echo '#4CAF50'; }else if(3 > $row['ratings'] && $row['ratings'] > 1){ echo '#ff9800'; }else{ echo '#f44336'; } ?>"><?php echo $row['ratings']; ?></div><?php }else{ ?><p class="small card align-self-center font-weight-bold text-secondary pl-1 pr-1 m-0 w-100">NILL</p><?php } ?>
              <a href="<?php echo $host; ?>/joinme/Company/userdetailedview?rawvalue=<?php echo $val; ?>&uid=<?php echo base64_encode($row['UId']); ?>" class="float-right col-xl-6 col-lg-6 col-md-6 m-0 p-0"><img src="../assets/images/icons/visibility.svg"></img></a>
              </div>
            </li>
          </ul>

          <?php
          } ?>
          <?php if($nr != 0){ ?>
<nav aria-label="...">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="jobrequests?rawvalue=<?php echo $val; ?>&ptitle=<?php echo $ptitle.'&pid='.base64_encode($postId); ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="jobrequests?rawvalue=<?php echo $val; ?>&ptitle=<?php echo $ptitle.'&pid='.base64_encode($postId); ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="jobrequests?rawvalue=<?php echo $val; ?>&ptitle=<?php echo $ptitle.'&pid='.base64_encode($postId); ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
<?php } ?>
        <?php }else{ ?>
        <ul class="list-group pl-3 card card-body">
            <li class="d-flex align-content-center">
              <h6 class="text-secondary font-weight-bold mr-3 w-100 text-center">No requests found</h6>
            </li>
          </ul>
          
          
        <?php
        }
        }
          ?>
          
       </div>
      

         </div>
       </div>
    </div>
</body>
</html>

<?php
        }
    }
}
ob_end_flush();
?>