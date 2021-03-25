<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);
    
    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
    $_SESSION['sidebarc'] = "basesalary";
if(!isset($_SESSION["logincompany"]) && empty($_SESSION["logincompany"])){
    header("Location: ".$host."/joinme/Company/login");
}else{
    if($_SESSION["logincompany"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
         $skills = "select * from skills";
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
    <script src="../js/jquery.js"></script>
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
       <nav aria-label="breadcrumb" class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">BASE SALARY</li>
  </ol>
</nav>
<form action="" method="POST" class="col-xl-12 col-lg-12 col-md-12">
       <div class="container-fluid row h-auto text-center w-100 justify-content-center p-5">

<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<select class="form-control" id="skill" name="skill" required>
  <option selected disabled value="novalue">Skill</option>
  <?php
$res = mysqli_query($con, $skills);
while($row = mysqli_fetch_array($res)){
    ?>
    <option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<select class="form-control" id="level" name="level" disabled required>
  <option selected disabled>Skill Level</option>
  <option value="1">Beginner</option>
  <option value="2">Intermediate</option>
  <option value="3">Expert</option>
</select>
</div>
<div class="input-group input-group-lg col-xl-6 col-lg-6 w-100 mb-3">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Rs.</span>
  </div>
  <input type="text" name="salary" id="salary" class="form-control" aria-label="no-emp add" aria-describedby="inputGroup-sizing-lg" placeholder="Salary" required>
</div>
        <div class="col-xl-12 col-lg-12 col-md-12 m-3">
<input type="submit" class="btn btn-primary" name="addbs" value="Add Base Salary" onclick="return confirm('Do you want to add this base salary?')">
        </div>
        
      
         </div>
       </form>
       </div>
       
       <nav aria-label="breadcrumb" class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0" id="skills">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">SKILLS AND BASE SALARY</li>
  </ol>
</nav>

<div class="row justify-content-center">
  <?php
  $select = "select * from companySalaryScale where CId=".base64_decode($id);
  if($res = mysqli_query($con, $select)){
  while($row = mysqli_fetch_array($res)){
  ?>
<div class="card col-xl-3 col-lg-3 col-md-3 m-3 p-0 hvr-grow-shadow">

          <div class="card-content p-0">
            <div class="card-body">
            <h3 class="w-100 text-center"><?php echo $row[2]; ?></h3>
            <h5 class="w-100 text-center"><?php
            switch($row[1]){
              case 1:{
                echo "Beginner";
              break;
              }
              case 2:{
                echo "Intermediate";
              break;
              }
              case 3:{
                echo "Expert";
              break;
              }
              default:{
                echo "Wrong data";
              break;
              }
            }
            ?></h5>
            <h5 class="w-100 text-center"><?php echo "Rs. ".$row[3]; ?></h5>
            <a href="../php/deletecompanyskills?rawvalue=<?php echo $val; ?>&cid=<?php echo $id; ?>&levels=<?php echo base64_encode($row['levels']); ?>&jtitle=<?php echo base64_encode($row['jTitle']); ?>" class="btn btn-danger w-100" onclick="return confirm('Do you want to delete?')">Delete</a>
              
            
            </div>
            
          </div>
        </div>

        
  <?php }
  }else{
    echo mysqli_error($con);
  }
  ?>
         </div>


       </div>
    </div>
<script>
  $('#level').prop('disabled', true)
  $('#salary').prop('disabled', true)
  $('#skill').on("change", function(){
    if(this.value != "novalue"){
  $('#level').prop('disabled', false)
  $('#level').on("change", function(){
    if(this.value != "novalue"){
    $('#salary').prop('disabled', false)
    }
  })
  }
  })


document.getElementById('salary').addEventListener('input', event =>
  event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
);


</script>
</body>
</html>

<?php
if(isset($_POST['addbs'])){
$skill = $_POST['skill'];
$slevel = $_POST['level'];
$salary = $_POST['salary'];

$check = "select * from companySalaryScale where CId=".base64_decode($id)." and levels=$slevel and jTitle='$skill'";

if($checkres = mysqli_query($con, $check)){
if(mysqli_num_rows($checkres) == 0){
  $addsalary = "insert into companySalaryScale values(".base64_decode($id).", $slevel, '$skill', '$salary')";
  if(mysqli_query($con, $addsalary)){
    echo '<script>
    window.alert("Base salary successfully added")
    window.location.href="basesalary?rawvalue='.$val.'"
    </script>';
  }else{
    echo mysqli_error($con);
  }

}else{
  echo '<script>
    window.alert("You already added this details")
    window.location.href="basesalary?rawvalue='.$val.'"
    </script>';
}
}else{
  echo mysqli_error($con);
}
}

        }
    }
}
?>