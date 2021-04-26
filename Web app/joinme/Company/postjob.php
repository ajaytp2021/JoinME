<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$_SESSION['sidebarc'] = "postjob";
    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/Company/login.php");
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
         $skills = "select distinct(jTitle), salary from companySalaryScale where CId=".base64_decode($id);
         $listposts = "select *, (select count(*) from usersOnProject where PId=posts.PId) as counts, (select sum(NoUsers) from prjSkills where PId=posts.PId and CId=posts.CId) as NoUsers, (select status from companyProjects where companyProjects.PId=posts.PId and companyProjects.CId=posts.CId) as status from posts where CId=".base64_decode($id)." order by YEAR(pDate) DESC, MONTH(pDate) DESC, DAY(pDate) DESC";
         if($countres = mysqli_query($con, $listposts)){
          $totalcount = mysqli_num_rows($countres);
          $currentpagecount = ceil($totalcount / $showpagecount);
          $this_page_first_result = (($page - 1) * $showpagecount);
          $listposts = $listposts." LIMIT ".$this_page_first_result.", ".$showpagecount;

        }
        $date = date("Y-m-d");
        $date = date_create($date);

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getName($con,'company', $id); ?></title>
    <style>
hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
    </style>
    <script>

    </script>
</head>

<div class="navbar navbar-dark bg-primary pt-4 pb-4 sticky-top">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    JoinME Home
  </a>
  <div class="text-white font-weight-bold" id="toptotal"></div>
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
    <li class="breadcrumb-item active" aria-current="page">POST JOB</li>
  </ol>
</nav>
</div>
<?php
if($res = mysqli_query($con, $skills)){
  if(mysqli_num_rows($res) > 0){
?>
<form action="../php/postjob.php?rawvalue=<?php echo $val; ?>" method="POST" class="col-xl-12 col-lg-12 col-md-12" id="formID">
<input type="hidden" name="cid" value="<?php echo $id; ?>">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center p-5">
       <div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="text" name="ptitle" id="ptitle" class="form-control" aria-label="ptitle add" aria-describedby="inputGroup-sizing-lg" placeholder="Project title / Post title" onkeyup="onCheck()" required>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="number" class="form-control h-100" name="edate" id="edate" aria-label="inputGroup-sizing-lg" placeholder="Expecting duration" min="1" oninput="validity.valid||(value='1');" onblur="changeToOne('edate')" >
  <div class="input-group-append">
    <select class="form-control h-100" id="dur" name="dur">
    <option selected disabled>Duration</option>
    <option value="day">Day(s)</option>
    <option value="week">Week(s)</option>
    <option value="month">Month(s)</option>
    </select>
</div>
</div>

<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<!-- <input type="date" min="2019-06-02" class="form-control" placeholder="Post Expiry date" aria-label="pexpire" aria-describedby="basic-addon1" name="pexpire" id="pexpire"> -->
<input type="text" class="form-control" max="3000-06-08" onfocus="this.type='date'" onblur="this.type='text'" onkeydown="return false" placeholder="Post expire date" name="pexpire" id="pexpire"/>
</div>

<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
  <input type="number" name="budget" id="budget" class="form-control" aria-label="skills add" aria-describedby="inputGroup-sizing-lg" placeholder="Project budget" oninput="validity.valid||(value='');" onblur="changeToOne('budget')" required>
</div>

<div class="input-group input-group-lg col-xl-12 col-lg-12 w-100 mb-3">
<!-- <select class="form-control" id="skill" name="skill" required>
  <option value="novalue" selected disabled>Skills</option>
<?php
// $res = mysqli_query($con, $skills);
// while($row = mysqli_fetch_array($res)){
    ?>
    <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
//  }
  ?>
</select> -->
<script>
var grandtotal = 0;
function checkInput(cbox, checkbox, type, salary, no) {
  console.log(no);
      if (cbox.checked) {
          document.getElementById(checkbox).style.visibility='visible';
          addRemoveSkills(type, salary, no,  true)
        }
      else{
            document.getElementById(checkbox).style.visibility='hidden';
          addRemoveSkills(type, salary, no,  false)
       }


 }
</script>
<div class="card col-xl-12 col-lg-12">
<div class="text-left mt-3 col-xl-12 col-lg-12 text-muted">Choose skills</div>
<table class="col-xl-12 col-lg-12 card-body p-3 w-100">
<tbody>
<?php
$res = mysqli_query($con, $skills);
$c = 0;
while($row = mysqli_fetch_array($res)){
  
    ?>
<tr class="m-3">
<td>
<table class="mr-5">
<tr>
<td><input type="checkbox" name="skill" id="skill<?php echo $c; ?>" onclick="checkInput(this, 'options<?php echo $c; ?>', 'skill<?php echo $c; ?>', 'salary<?php echo $c; ?>', 'noemp<?php echo $c; ?>')" value="<?php echo base64_encode($row['jTitle']); ?>" /><input type="hidden" name="salary<?php echo $c; ?>" id="salary<?php echo $c; ?>" value="<?php echo base64_encode($row['salary']); ?>" /></td><td><?php echo $row[0]; ?> - </td></tr>
</table>
</td>
<td>
<div id="options<?php echo $c; ?>" style="visibility: hidden;" class="text-muted">
<?php echo '&#8377;'.$row['salary'].' Person/Month'; ?> <input type="number" style="width: 20%; height: 15%" placeholder="No." min="1" oninput="validity.valid||(value='1');" name="noemp<?php echo $c; ?>" id="noemp<?php echo $c; ?>"  onkeyup="updateCount('skill<?php echo $c; ?>', 'salary<?php echo $c; ?>', 'noemp<?php echo $c; ?>', 'onkey')" onblur="updateCount('skill<?php echo $c; ?>', 'salary<?php echo $c; ?>', 'noemp<?php echo $c; ?>', 'blur')" value="1" />
<!-- <div id="options<?php echo $c; ?>" style="visibility: hidden"><input type="radio" name="level<?php echo $c; ?>" id="beginner" checked /> Beginner <input type="radio" name="level<?php echo $c; ?>" id="intermediate" /> Intermediate <input type="radio" name="level<?php echo $c; ?>" id="expert" /> Expert 
<input type="number" style="width: 15%; height: 15%" placeholder="No." min="1" oninput="validity.valid||(value='');" name="noemp<?php //echo $c; ?>" /> -->
<!-- </div> -->
</div>
</td>
</tr>
<?php $c = $c + 1; } ?>
<input type="hidden" name="data" id="data" value="" />
</tbody>
</table>
<hr />
<div class="w-100 font-weight-bold text-right mb-3 text-muted"><div id="gtotal">Grand Total Amount : &#8377; 0</div></div>
</div>
</div>
<!-- <div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<select class="form-control" id="level" disabled required>
<option selected disabled>Choose Skill First</option>
</select>
</div> -->

<div class="input-group input-group-lg col-xl-12 col-lg-12 w-100 mb-3">
  <textarea class="form-control" name="desc" id="desc" placeholder="Description" onkeyup="onCheck()" required></textarea>
</div>
  </div>
  
        <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
<input type="submit" class="btn btn-primary" id="calculate" name="calculate" value="Post job" onclick="return confirm('Do you want to post this job?')" data-toggle="modal" data-target="#myModal">
        </div>
        
        </form>
        
        <?php  }else{
          echo '<div class="alert alert-info">You are unable to post any job. Because you have not add any base salary for your job posting.</div>';
        } } ?>
      
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
       <nav aria-label="breadcrumb" id="posts">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">OUR POST LIST</li>

  </ol>
  <a href="generateReportPosts.php?rawvalue=<?php echo $val.'&cid='.$id; ?>" class="float-right mb-2">Generate posts' report</a>
</nav>
<?php
         if($res = mysqli_query($con, $listposts)){
while($row = mysqli_fetch_array($res)){ 
  $skillList = "select skill from prjSkills where PId=".$row['PId']." and CId=".$row['CId'];
  ?>

<ul class="list-group pl-3 card card-body col-xl-12 col-lg-12 col-md-12 mb-3   <?php if($row['status'] != null){ if($row['status'] == 1){ echo 'border-success'; }else if($row['status'] == 2){ echo 'border-info'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'border-warning'; } } ?>" id="<?php echo base64_encode($row['PId']); ?>">
            <li class="d-flex align-content-center">
            <div class="w-100 row">
            <div class="col-xl-12 col-lg-12 col-md-12 mr-3 row">
            <h6 class="text-secondary text-left font-weight-bold w-100 col-xl-8 col-lg-8 col-md-8 text-uppercase"><?php echo $row['pTitle']; ?></h6>
            <div class="col-xl-4 col-lg-4 col-4 pl-0 mt-2">
            <?php
             if($row['status'] == null){ if($row['NoUsers'] == $row['counts']){ 
               ?>
            <a href="../php/startprj.php?rawvalue=<?php echo $val; ?>&cpid=<?php echo base64_encode($row['PId']); ?>&cid=<?php echo base64_encode($row['CId']); ?>&prtitle=<?php echo base64_encode($row['pTitle']); ?>&psdate=<?php echo base64_encode(date("Y-m-d")); ?>&duration=<?php echo base64_encode($row['duration']); ?>&texp=<?php echo base64_encode($row['tExp']); ?>" class="w-100 float-right text-right text-decoration-none" style="width: fit-content;" onclick="return confirm('Do you want to start this project?')"><img src="../assets/images/icons/playbutton.svg"> Start</img></a>
            <?php
           } }else if($row['status'] == 1){ 
             ?>
              <a href="../php/stopprj.php?rawvalue=<?php echo $val; ?>&cpid=<?php echo base64_encode($row['PId']); ?>&cid=<?php echo base64_encode($row['CId']); ?>" class="w-100 float-right text-right text-decoration-none" style="width: fit-content;" onclick="return confirm('Do you want to stop this project?')"><img src="../assets/images/icons/stop.svg"> Stop</img></a>
              <?php
             } 
             ?>
            </div>
            <small class="pl-3 font-weight-bold text-muted w-100">Skills needed for this project : </small>
            <div class="pl-3 w-100">
           <?php
           $fetchSkills = "select skill, NoUsers as no from prjSkills where PId=".$row['PId']." and CId=".$row['CId'];
           if($r = mysqli_query($con, $fetchSkills)){
             while($rows = mysqli_fetch_array($r)){
               ?><span class="badge badge-pill badge-dark mr-1"><?php echo $rows['skill']; ?> - <?php echo $rows['no']; ?></span></td>
               <?php
             }
           }else{
             echo mysqli_error($con);
           }
           ?>
           </div>
            <div class="col-xl-8 col-lg-8 col-md-8 w-100">
            <small class="text-left float-left col-xl-12 col-lg-12 col-12 font-weight-bold mt-1 pl-2 pr-2 <?php 
            if($row['status'] != null){ if($row['status'] == 1){ echo 'bg-success rounded p-1 text-white'; }else{ echo 'bg-info rounded p-1 text-white'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'bg-warning rounded p-1 text-dark'; } } 
            ?>" style="width: fit-content; background-image: url(<?php 
            if($row['status'] == 1){ echo '../assets/images/icons/loadingbtn.svg'; } 
            ?>)"><?php
             if($row['status'] != null){ if($row['status'] == 1){ echo 'Project is in progress...'; }else{ echo 'Project has completed'; } }else{ if($row['NoUsers'] == $row['counts']){ echo 'This project is ready to start'; } } 
             ?></small>
            </div>
            </div>
            </div>
           
            </li>
            <div class="col-xl-12 col-lg-12 col-md-12 row pb-2 w-100 justify-content-end">
            <div class="col-xl-12 col-lg-12 col-12">
            <small class="text-secondary text-left float-right text-right col-xl-12 col-lg-12 col-12 pr-0"><a href="uop.php?rawvalue=<?php echo $val; ?>&ptitle=<?php echo base64_encode($row['pTitle']).'&pid='.base64_encode($row['PId']); ?>">Users on project</a></small>
            <small class="text-secondary text-left float-right text-right col-xl-12 col-lg-12 col-12 pr-0"><a href="jobrequests.php?rawvalue=<?php echo $val; ?>&ptitle=<?php echo base64_encode($row['pTitle']).'&pid='.base64_encode($row['PId']); ?>">Total job requests</a></small>
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
      <a class="page-link" <?php if($page > 1){ ?> href="postjob.php?rawvalue=<?php echo $val; ?>&page=<?php echo pageBack($page); ?>#posts" <?php } ?>>Previous</a>
    </li>
    <?php
for($pcount = 1; $pcount <= $currentpagecount; $pcount++){
?>
    <li class="page-item <?php if($pcount == $page){ echo 'active'; } ?>"><a class="page-link" <?php if($pcount != $page){ ?> href="postjob.php?rawvalue=<?php echo $val; ?>&page=<?php echo $pcount; ?>#posts" <?php } ?>><?php echo $pcount; ?></a></li>

<?php } ?>
    <li class="page-item <?php if($currentpagecount == $page){ echo 'disabled'; } ?>">
      <a class="page-link" <?php if($currentpagecount != $page){ ?> href="postjob.php?rawvalue=<?php echo $val; ?>&page=<?php echo pageForward($page); ?>#posts" <?php } ?>>Next</a>
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
    var finalArray = [];
    var salAll=new Object();
    let sal;
    var exceed = 0;
    const addRemoveSkills = (type, salary, no, isChecked) => {
      let data = {};
      var skilltype = document.getElementById(type).value;
      var skillsalary = document.getElementById(salary).value;
      var skillno = document.getElementById(no).value;
      if(isChecked){
        Object.assign(data, {
          type: skilltype,
          salary: skillsalary,
          no: skillno
        });
        finalArray.push(data);
        let position = finalArray.indexOf({
          type: skilltype,
          salary: skillsalary,
          no: skillno
        });
        var salaries = atob(skillsalary).replace(/,/g, "");
        sal={[type]:salaries * skillno};
      Object.assign(salAll,sal);
      }else{
        let position=finalArray.findIndex((_eachItem)=>{
          const {type:_type}=_eachItem;
          return _type==skilltype
        });
        if(position>=0){ 
          finalArray.splice(position, 1);
        }else{
          console.log('no data found')
        }
        delete salAll[type];
        
      }
      console.log(finalArray)
        console.log(salAll)
      total(salAll);

    }


    const setOne = () => {
      if(document.getElementById('edate').value == ''){
        document.getElementById('edate').value = '1';
      }
    }

    const changeToOne = (no) => {
      if(document.getElementById(no).value == '' || document.getElementById(no).value == 0){
        document.getElementById(no).value = '1';
      }else{
        if(no === 'edate'){
    $("#pexpire").prop('disabled', false);
        }
      }
    }

    var total = (salAll) => {
      var t = 0;
      var duration = document.getElementById("edate").value;
      var durType = document.getElementById("dur").value;
      var month = 0;
      switch(durType){
        case "day": {
          month = duration / 30;
          break;
        }
        case "week": {
          month = duration / 4;
          break;
        }
        case "month": {
          month = duration;
          break;
        }
      }

      if(month < 1){
        month = 1;
      }else{
        month = Math.ceil(month);
      }

      Object.values(salAll).map(_each => {
        t += _each * month;
      })
      var ba = parseInt(document.getElementById('budget').value);
      var gtotal = document.getElementById("gtotal");
      var toptotal = document.getElementById("toptotal");
      if(t > ba){
        exceed = 1;
        gtotal.classList.remove("text-muted")
        gtotal.classList.add("text-danger")
        gtotal.innerHTML = "Grand total amount has exceeded to the budget";
        toptotal.innerHTML = "With this budget the project can't complete within " + duration + " " + durType + "(s)";
      }else{
        exceed = 0;
        gtotal.classList.add("text-muted")
        gtotal.classList.remove("text-danger")
        gtotal.innerHTML = "Grand Total Amount : &#8377; " + t;
        toptotal.innerHTML = "Grand Total Amount : &#8377; " + t;

      }
      document.getElementById('data').value = btoa(JSON.stringify(finalArray));
    }
    

    const updateCount = (type, salary, no, check) => {
      if(check == 'blur'){
      if(document.getElementById(no).value == '' || document.getElementById(no).value == 0){
        document.getElementById(no).value = '1';
      }
    }

      var skilltype = document.getElementById(type).value;
      var skillsalary = document.getElementById(salary).value;
      var skillno = document.getElementById(no).value || 0;

      var salaries = atob(skillsalary).replace(/,/g, "");
        let position=finalArray.findIndex((_eachItem)=>{
          const {type:_type, salary:_salary}=_eachItem;
          return _type==skilltype && _salary==skillsalary
        });
        finalArray[position].no = document.getElementById(no).value
        document.getElementById('data').value = finalArray
        // setSkillAmounts(type);
        sal={[type]:salaries * skillno};
      Object.assign(salAll,sal);
      total(salAll);
      console.log('onkeyup')
    }

    var today = new Date();
    let cur_date = today.toISOString().split('T')[0];
    console.log(cur_date)
    document.getElementById('pexpire').min = cur_date;
$('input:checkbox').change(
    function(){
        if ($(this).is(':checked')) {
    $("#desc").prop('disabled', false);
        }else{
          if ($("#formID input:checkbox:checked").length === 0){
    $("#desc").prop('disabled', true);
          }
          
        }
    });

    $('#edate').on('keyup', () =>{
      if(document.getElementById('edate').value != ''){
        $('#pexpire').prop('disabled', false);
      }else{
        $('#pexpire').prop('disabled', true);
      }
      if ($('input:checkbox').is(':checked')) {
        total(salAll);
      }
    })

    $("#pexpire").on("change", () => {
    $("#budget").prop('disabled', false);
    })

    $("#edate").prop('disabled', true);
    $("#pexpire").prop('disabled', true);
    $("input:checkbox").prop('disabled', true);
    $("#desc").prop('disabled', true);
    $("#budget").prop('disabled', true);
    $("#calculate").prop('disabled', true);
$('#dur').on("change", function(){
  $('#edate').prop('disabled', false);
  if ($('input:checkbox').is(':checked')) {
    total(salAll);
  }
})

$('#budget').on("keyup", function(){
  var bdg = document.getElementById('budget').value;
  if(bdg == 0 || bdg == ''){
  $("input:checkbox").prop('disabled', true);
  }else{
    if(bdg >= 10000){
      total(salAll);
  $("input:checkbox").prop('disabled', false);
    }else{
  $("input:checkbox").prop('disabled', true);

    }
  }
})
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

function onCheck(){
  var title = document.getElementById('ptitle').value;
  var dur = document.getElementById('edate').value;
  var enddate = document.getElementById('pexpire').value;
  var desc = document.getElementById('desc').value;
  console.log(title)
  console.log(desc)
  if(title == '' || desc == '' || dur == '' || enddate == '' || exceed == 1){
    $("#calculate").prop('disabled', true);
  }else{
    $("#calculate").prop('disabled', false);
  }
}


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