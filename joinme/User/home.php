<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "home";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported <br>";
        echo $_SESSION["loginuser"]."<br>";
        echo $val;
    }else{
        if($con){
          $showpagecount = 6;
          if(!isset($_GET['page'])){
            $page = 1;
          }else{
            $page = $_GET['page'];
          }
          $skills = "select DISTINCT(skills.skill) from userSkill inner join skills on userSkill.SKId=skills.SKId where userSkill.UId=".base64_decode($id);
          if($res = mysqli_query($con, $skills)){
            if(mysqli_num_rows($res) != 0){
              $posts = "select posts.*, company.cname from posts inner join company on company.CId=posts.CId where jTitle in (select DISTINCT(skills.skill) from userSkill inner join skills on userSkill.SKId=skills.SKId where userSkill.UId=".base64_decode($id).") and (Ulevel in (select DISTINCT(levels) from userSkill where userSkill.UId=".base64_decode($id).")) and EDate >= '".date('Y-m-d')."' order by pDate desc";
            }else{
              $posts = "select posts.*, company.cname from posts inner join company on company.CId=posts.CId where EDate >= '".date('Y-m-d')."' order by pDate desc";
            }
          }
          if($countres = mysqli_query($con, $posts)){
            $totalcount = mysqli_num_rows($countres);
            $currentpagecount = ceil($totalcount / $showpagecount);
            $this_page_first_result = (($page - 1) * $showpagecount);
            $posts = $posts." LIMIT ".$this_page_first_result.", ".$showpagecount;

          }


            
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
    <li class="breadcrumb-item active" aria-current="page">JOB LIST</li>
  </ol>
</nav>
</div>

<?php
if($res = mysqli_query($con, $posts)){
  $nr = mysqli_num_rows($res);
  if($nr != 0){
    while($row = mysqli_fetch_array($res)){
      ?>
<a href="postdetailed?rawvalue=<?php echo $val; ?>&details=<?php echo base64_encode($posts); ?>&pid=<?php echo base64_encode($row[0]); ?>&cid=<?php echo base64_encode($row[1]); ?>" class="p-0 m-0 text-decoration-none col-xl-12 col-lg-12 col-md-12">
<ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-8 col-lg-8 col-md-8 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-12 col-lg-12 col-md-12 text-uppercase"><?php echo $row[2]; ?></h6>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12"><?php echo $row[7]." - ".$row[6]; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">No.of Employees needed : <?php echo $row[5]; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">Company : <?php echo $row['cname']; ?></small>
            <small class="text-secondary w-100 text-left col-xl-12 col-lg-12 col-md-12">Salary : Rs.<?php echo $row['salary']; ?></small>
            </div>
            </div>
              <div class="col-xl-4 col-lg-4 col-md-4 mr-3 row h-100 d-flex flex-column pr-0">
              <small class="text-secondary align-bottom h-auto w-100 float-right col-xl-12 col-lg-12 col-md-12 m-0 p-0 align-bottom h-100 align-text-bottom">End Date : <?php echo $row[4]; ?></small>
             </div>
            </li>
          </ul>
          </a>
          <?php
    }
  }else{
    ?>
    <div class="w-100 h-100">
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h5 m-3 text-secondary">No job posts are currently available</p>
</div>
    <?php
  }
}
?>
<?php if($nr != 0){ ?>
<nav aria-label="...">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="home?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="home?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="home?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
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
?>