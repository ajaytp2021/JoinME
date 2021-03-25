<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
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
         $skills = "select distinct(jTitle) from companySalaryScale where CId=".base64_decode($id);
         $listposts = "select *, (select count(*) from usersOnProject where CPId=posts.PId) as counts, (select status from companyProjects where companyProjects.CPId=posts.PId and companyProjects.CId=posts.CId) as status from posts where CId=".base64_decode($id)." order by YEAR(pDate) DESC, MONTH(pDate) DESC, DAY(pDate) DESC";
         if($countres = mysqli_query($con, $listposts)){
          $totalcount = mysqli_num_rows($countres);
          $currentpagecount = ceil($totalcount / $showpagecount);
          $this_page_first_result = (($page - 1) * $showpagecount);
          $listposts = $listposts." LIMIT ".$this_page_first_result.", ".$showpagecount;

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
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,'company', $id); ?></title>
</head>

<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    JoinME Home
  </a>
</div>
<body class="w-100 h-100">
    <div class="container-fluid row h-auto w-100">
       <div class="col-2 col-sm-4 col-md-3 col-lg-3 col-xl-3 h-100 p-0 align-items-start w-100">
       <?php include('sidebar.php'); ?>
       </div>
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 border-left h-100">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center pt-2">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">POST JOB</li>
  </ol>
</nav>
</div>
<form action="postjobcalculate?rawvalue=<?php echo $val; ?>" method="POST" class="col-xl-12 col-lg-12 col-md-12">
<div class="modal" id="modalbody"></div>
<input type="hidden" name="cid" value="<?php echo $id; ?>">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center p-5">
       <div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="text" name="ptitle" id="ptitle" class="form-control" aria-label="ptitle add" aria-describedby="inputGroup-sizing-lg" placeholder="Project title / Post title" required>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="text" class="form-control h-100" name="edate" id="edate" aria-label="inputGroup-sizing-lg" placeholder="Expecting duration">
  <div class="input-group-append">
    <select class="form-control h-100" id="dur" name="dur">
    <option selected disabled>Duration</option>
    <option value="day">Day</option>
    <option value="week">Week</option>
    <option value="month">Month</option>
    </select>
</div>
</div>

<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<select class="form-control" id="skill" name="skill" required>
  <option value="novalue" selected disabled>Skills</option>
  <?php
$res = mysqli_query($con, $skills);
while($row = mysqli_fetch_array($res)){
    ?>
    <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php } ?>
</select>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<select class="form-control" id="level" disabled required>
<option selected disabled>Choose Skill First</option>
</select>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="text" name="budget" id="budget" class="form-control" aria-label="skills add" aria-describedby="inputGroup-sizing-lg" placeholder="Project budget" required>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<input type="text" class="form-control" placeholder="Post Expiry date" aria-label="pexpire" aria-describedby="basic-addon1" onfocus="(this.type='date')" onblur="(this.type='text')" name="pexpire" id="pexpire">
</div>
<div class="input-group input-group-lg col-xl-12 col-lg-12 w-100 mb-3">
  <textarea class="form-control" name="desc" id="desc" placeholder="Description" required></textarea>
</div>
  </div>
  
        <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
<input type="submit" class="btn btn-primary" id="calculate" name="calculate" value="Calculate" onclick="return confirm('Do you want to calculate?')" data-toggle="modal" data-target="#myModal">
        </div>
        
        </form>
      
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb" id="posts">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">OUR POST LIST</li>
  </ol>
</nav>
<?php
         if($res = mysqli_query($con, $listposts)){
while($row = mysqli_fetch_array($res)){ ?>

<ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3 <?php if($row['status'] != null){ if($row['status'] == 1){ echo 'border-success'; }else if($row['status'] == 2){ echo 'border-info'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'border-warning'; } } ?>" id="<?php echo base64_encode($row['PId']); ?>">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-12 col-lg-12 col-md-12 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-8 col-lg-8 col-md-8 text-uppercase"><?php echo $row['pTitle']; ?></h6>
            <div class="col-xl-4 col-lg-4 col-4 pl-0 mt-2">
            <?php if($row['status'] == null){ if($row['NoUsers'] == $row['counts']){ ?><a href="../php/startprj?rawvalue=<?php echo $val; ?>&cpid=<?php echo base64_encode($row['PId']); ?>&cid=<?php echo base64_encode($row['CId']); ?>&prtitle=<?php echo base64_encode($row['pTitle']); ?>&psdate=<?php echo base64_encode(date("Y-m-d")); ?>&pcdate=<?php echo base64_encode($row['durDate']); ?>&texp=<?php echo base64_encode($row['tExp']); ?>" class="w-100 float-right text-right text-decoration-none" style="width: fit-content;" onclick="return confirm('Do you want to start this project?')"><img src="../assets/images/icons/playbutton.svg"> Start</img></a><?php } }else if($row['status'] == 1){ ?>
              <a href="../php/stopprj?rawvalue=<?php echo $val; ?>&cpid=<?php echo base64_encode($row['PId']); ?>&cid=<?php echo base64_encode($row['CId']); ?>" class="w-100 float-right text-right text-decoration-none" style="width: fit-content;" onclick="return confirm('Do you want to stop this project?')"><img src="../assets/images/icons/stop.svg"> Stop</img></a><?php } ?>
            </div>
            <small class="text-secondary w-100 text-left col-xl-8 col-lg-8 col-md-8"><?php echo $row['jTitle']." - ".$row['Ulevel']; ?></small>
            <small class="text-secondary w-100 text-left col-xl-8 col-lg-8 col-md-8">No. of employees needed : <?php echo $row['NoUsers']; ?></small>            
            <div class="col-xl-8 col-lg-8 col-md-8 w-100">
            <small class="text-left float-left col-xl-12 col-lg-12 col-12 font-weight-bold mt-1 pl-2 pr-2 <?php if($row['status'] != null){ if($row['status'] == 1){ echo 'bg-success rounded p-1 text-white'; }else{ echo 'bg-info rounded p-1 text-white'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'bg-warning rounded p-1 text-dark'; } } ?>" style="width: fit-content; background-image: url(<?php if($row['status'] == 1){ echo '../assets/images/icons/loadingbtn.svg'; } ?>)"><?php if($row['status'] != null){ if($row['status'] == 1){ echo 'Project is in progress...'; }else{ echo 'Project has completed'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'This project is ready to start'; } } ?></small>
            </div>
            </div>
            </div>
           
            </li>
            <div class="col-xl-12 col-lg-12 col-md-12 row pb-2 w-100 justify-content-end">
            <div class="col-xl-12 col-lg-12 col-12">
            <small class="text-secondary text-left float-right text-right col-xl-12 col-lg-12 col-12 pr-0"><a href="uop?rawvalue=<?php echo $val; ?>&ptitle=<?php echo base64_encode($row['pTitle']).'&pid='.base64_encode($row['PId']); ?>">Users on project</a></small>
            <small class="text-secondary text-left float-right text-right col-xl-12 col-lg-12 col-12 pr-0"><a href="jobrequests?rawvalue=<?php echo $val; ?>&ptitle=<?php echo base64_encode($row['pTitle']).'&pid='.base64_encode($row['PId']); ?>">Total job requests</a></small>
            <small class="text-right float-right text-right col-xl-12 col-lg-12 col-12 <?php if(date('Y-m-d') > $row['EDate']){ echo 'bg-danger rounded p-1 text-white'; }else{ echo 'text-secondary pr-0'; }; ?>" style="width: fit-content;"><?php if(date('Y-m-d') > $row['EDate']){ ?>Post view expired<?php }else{ ?>End Date : <?php echo $row['EDate']; }?></small>
            </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 w-100 row justify-content-end">
            </div>
          </ul>
          <?php } ?>
          <?php
           if(mysqli_num_rows($res) != 0){ ?>
<nav aria-label="...">
  <ul class="pagination justify-content-center">
  <li class="page-item <?php if($page == 1){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($page > 1){ ?> href="postjob?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>#posts" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="postjob?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>#posts" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="postjob?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>#posts" <?php } ?>>Next</a>
    </li>
  </ul>
</nav>
<?php } ?>
          <?php }else{
            echo mysqli_error($con);
          } ?>
       </div>
       

         </div>
       </div>
    </div>
    <script>
    
$(document).on("change", "#skill", function(e){
  var val = $('#skill').val();
  var level = $('#level');
  $.ajax({
        url: "../php/pjsl?skill="+val,
        type: 'GET',
        dataType: 'JSON',
         error: function (xhr, ajaxOptions, thrownError) {
    alert(xhr.status);
    alert(thrownError);
  },
  success: function(res){
    var len = res.length;

                $("#level").empty();
                $("#level").prop('disabled', false);
                $("#level").prepend("<option selected disabled>Select Skill Level</option>");
                for( var i = 0; i<len; i++){
                    var id = res[i]['id'];
                    var level = res[i]['level'];
                    
                    $("#level").append("<option value='"+id+"'>"+level+"</option>");

                }
    
  }
    });
  
})
    $("#budget").prop('disabled', true);
    $("#pexpire").prop('disabled', true);
document.getElementById('skill').onchange = function () {
  if(this.value != 'novalue'){
    document.getElementById('level').onchange = function(){
      if(this.value != 'novalue'){
    $("#budget").prop('disabled', false);
    $("#pexpire").prop('disabled', false);
      }
    }

  }

}
$('#edate').prop('disabled', true)
$('#dur').on("change", function(){
  $('#edate').prop('disabled', false)
})

document.getElementById('budget').addEventListener('input', event =>
  event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
);

bootstrapValidate(['#ptitle','#edate','#noemp','#budget','#desc'], 'required:Please fill out this field!');
bootstrapValidate('#ptitle', 'regex:^[a-zA-Z]+$:Invalid format');
bootstrapValidate('#edate', 'regex:^[0-9]+$:Number only');
bootstrapValidate('#noemp', 'regex:^[0-9]+$:Invalid format');
bootstrapValidate('#budget', 'regex:^[0-9,]+$:Invalid format');
    </script>
</body>
</html>

<?php
        }
    }
}
?>