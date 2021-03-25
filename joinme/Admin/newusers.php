<?php
require '../php/con.php';
require '../global/global.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
    $val = "";
    $val = $_GET["rawvalue"];
    $_SESSION['sidebar'] = "home";
if(!isset($_SESSION["login"]) && empty($_SESSION["login"])){
    header("Location: ".$host."/joinme/Admin/login");
}else{
    if($_SESSION["login"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
            $apusers = "select users.UId, users.name, address.email, address.img from ((users inner join address on users.UId=address.CUId inner join login on users.UId=login.Lid and login.approve=0)) order by users.UId asc";
            $showpagecount = 6;
            if(!isset($_GET['page'])){
              $page = 1;
            }else{
              $page = $_GET['page'];
            }
            if($countres = mysqli_query($con, $apusers)){
              $totalcount = mysqli_num_rows($countres);
              $currentpagecount = ceil($totalcount / $showpagecount);
              $this_page_first_result = (($page - 1) * $showpagecount);
              $apusers = $apusers." LIMIT ".$this_page_first_result.", ".$showpagecount;
            }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-icons.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/hover.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script language="JavaScript" type="text/javascript">
function confirms(val, e){
  e.preventDefault();
  confirm('Do you want to approve '.val.' ?')
  {
    return true
    }
    else
      {
        return false
        }
  }
</script>
</head>


<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Admin Dashboard
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-100 w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left">
       <div class="container-fluid row h-auto w-100 pt-2 justify-content-center">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb mb-5">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $host; ?>/joinme/Admin/dashboard?rawvalue=<?php echo $val; ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Total New User Requests( <?php echo newReqUsers($con); ?> )</li>
  </ol>
</nav>
</div>

<?php
        if($res = mysqli_query($con, $apusers))
        {
          $nr = mysqli_num_rows($res);
          $no = 0;
          if($nr > 0){
            $rev = array();
          while($row = mysqli_fetch_array($res)){
            $rev[] = $row;
          }
          $rev = array_reverse($rev);
          foreach($rev as $row){
        ?>
        <ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3 hvr-overline-reveal">
            <li class="d-flex align-content-center">
            <img src="<?php echo $host.'/joinme/assets/images/profile_pic/'.$row[3]; ?>" class="img-fluid mr-3" style="clip-path: circle(50% at 50% 50%);" width="100px" alt="profile pic" onerror="this.onerror=null; this.src='../assets/images/icons/nobody.jpg'"></img>
            <div class="w-100 row">
            <div class="col-xl-12 col-lg-12 col-md-12 mr-3">
            <h6 class="text-secondary font-weight-bold w-100"><?php echo $row[1]; ?></h6>
            <small class="text-secondary w-100 text-left"><?php echo $row[2]; ?></small>
            </div>
            </div>
            <h5 class="float-right text-right mr-5 text-secondary">ID:&nbsp;<?php echo $row[0]; ?></h5>
              <div class="row">
              <a href="<?php echo $host; ?>/joinme/Admin/viewnewusers?rawvalue=<?php echo $val; ?>&id=<?php echo $row[0]; ?>" class="col-xl-12 col-lg-12 col-md-12 mb-3"><img src="../assets/images/icons/visibility.svg" class="float-right"></img></a>
              <a href="<?php echo $host; ?>/joinme/php/approve?rawvalue=<?php echo $val; ?>&id=<?php echo $row[0]; ?>&t=newusers" class="float-right col-xl-6 col-lg-6 col-md-6 m-0 p-0" onclick="return confirm('Approve <?php echo $row[1]; ?> request?')"><img src="../assets/images/icons/check.svg"></img></a>
              <a href="<?php echo $host; ?>/joinme/php/reject?rawvalue=<?php echo $val; ?>&id=<?php echo $row[0]; ?>&t=newusers" class="float-right col-xl-6 col-lg-6 col-md-6 m-0 p-0" onclick="return confirm('Reject <?php echo $row[1]; ?> request?')"><img src="../assets/images/icons/remove.svg"></img></a>
              </div>
            </li>
          </ul>
          <?php
          }
        }else{ ?>
        <ul class="list-group pl-3 card card-body">
            <li class="d-flex align-content-center">
              <h6 class="text-secondary font-weight-bold mr-3 w-100 text-center">No new users' requests found</h6>
            </li>
          </ul>
        <?php
        }
        }
          ?>
           <?php if($nr != 0){ ?>
<nav aria-label="...">
  <ul class="pagination">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="newusers?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="newusers?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="newusers?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>" <?php } ?>>Next</a>
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