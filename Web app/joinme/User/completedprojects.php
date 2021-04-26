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
    header("Location: ".$host."/User/login.php");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $showpagecount = 1;
          if(!isset($_GET['page'])){
            $page = 1;
          }else{
            $page = $_GET['page'];
          }
          // $curworks = "select companyProjects.*, company.cname, posts.*, jobApply.UId from companyProjects inner join company on company.CId=companyProjects.CId inner join jobApply on jobApply.PId=companyProjects.CPId inner join posts on posts.PId=companyProjects.CPId inner join usersOnProject on jobApply.UId=usersOnProject.UId where companyProjects.status!=2 and usersOnProject.UId=".base64_decode($id);
          $completedworks = "select distinct jobApply.*, posts.*, company.*, companyProjects.status from jobApply inner join company on company.CId=jobApply.CId inner join usersOnProject on usersOnProject.UId=jobApply.UId inner join posts on posts.PId=jobApply.PId inner join companyProjects on companyProjects.CPId=jobApply.PId where jobApply.UId=".base64_decode($id)." and companyProjects.status=2";
          if($countres = mysqli_query($con, $completedworks)){
            $totalcount = mysqli_num_rows($countres);
            $currentpagecount = ceil($totalcount / $showpagecount);
            $this_page_first_result = (($page - 1) * $showpagecount);
            $completedworks = $completedworks." LIMIT ".$this_page_first_result.", ".$showpagecount;
  
          }
          if($res = mysqli_query($con, $completedworks)){

        
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
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
       <div class="container-fluid row h-auto text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="currentwork.php?rawvalue=<?php echo $val; ?>" class="text-decoration-none">MY CURRENT WORK</a></li>
    <li class="breadcrumb-item active" aria-current="page">MY COMPLETED WORKS</li>
  </ol>
</nav>
</div>
<?php
if(mysqli_num_rows($res) != 0){
  while($row = mysqli_fetch_array($res)){
  ?>
<ul class="list-group pl-3 card card-body border-success col-xl-12 col-lg-12 col-md-12 mb-3">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-10 col-lg-10 col-md-10 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo $row[6]; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo "Company : ".$row['cname']; ?></small>
            <small class="pl-3 text-muted w-100 text-left">Skills needed for this project : </small>
            <div class="w-100 text-left pl-3">
           <?php
           $fetchSkills = "select skill, NoUsers as no from prjSkills where PId=".$row['PId']." and CId=".$row['CId'];
           if($r = mysqli_query($con, $fetchSkills)){
             while($rows = mysqli_fetch_array($r)){
               ?><span class="badge badge-pill badge-dark mr-1"><?php echo $rows['skill']; ?></span></td>
               <?php
             }
           }else{
             echo mysqli_error($con);
           }
           ?>
           </div>
            </div>
            </div>
              <div class="col-xl-2 col-lg-2 col-md-2 mr-3 row">
              <small class="align-bottom font-weight-bold w-100 float-right col-xl-12 col-lg-12 col-md-12 m-0 p-0 align-bottom align-text-bottom rounded text-white text-uppercase"><p class="rounded text-white p-1 bg-success">Completed</p></small>
             </div>
            </li>
          </ul>
          <?php } ?>
<nav aria-label="...">
  <ul class="pagination justify-content-center">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="completedprojects.php?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="completedprojects.php?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="completedprojects.php?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
          <?php }else{ ?>
            <div class="w-100 h-100">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">NO COMPLETED PROJECTS</p>
</div>
          <?php } ?>
         </div>
       </div>
    </div>
</body>
</html>

<?php
          }
        }
    }
}
?>