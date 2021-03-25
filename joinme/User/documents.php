<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $_SESSION['sidebaru'] = "documents";
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $skills = "select * from userSkill where UId=".base64_encode($id);
        
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/dropzone.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/formValidation.js" />
    <title><?php getName($con,'users', $id); ?></title>

    <!-- Custom styles -->
    <link href="../css/jquery.dm-uploader.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
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
       <div class="col-10 col-sm-8 col-md-9 col-lg-9 col-xl-9 w-100 m-0 overflow-auto span6 border-left pt-2 pl-3">
       <div class="col-xl-12 col-lg-12 col-md-12 pl-0 pr-0 pt-0">
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">DOCUMENT UPLOAD</li>
  </ol>
</nav>
        </div>
<p class="w-100 text-center font-weight-bold head-6 text-secondary h4">Choose your doc file from your device</p>
<p class="w-100 text-center head-6 text-secondary h6">Documents to be uploaded are ( CV, Experience Cert., Internship / Course Cert. )</p>
<form action="../php/uploadDoc?rawvalue=<?php echo $val; ?>" method="post" enctype="multipart/form-data">
       <div class="dropzone w-100 h-auto p-5 mt-3 text-center">
         <div class="w-100 align-items-center"><img src="../assets/images/icons/pdfupload.svg" height="100" width="auto"/></div>
         <div class="dropdown mt-2">
  <select class="btn btn-primary" id="doctype" name="doctype">
  <option value="novalue" selected disabled>Choose document type</option>
  <option value="cv">CV</option>
  <option value="ec">Experience Cert.</option>
  <option value="ic">Intership / Course Cert.</option>
        </select>
</div>
       <p class="w-100 text-center text-secondary h6 mt-5">You choose your document by clicking the button below</h>
       <input type="button" class="btn btn-primary btn-block" id="choosefile" value="Open the file Browser">
            <input type="file" title='Click to add Files' style="display: none" id="file" name="pdf" accept="application/pdf"/>
            <input type="submit" class="btn btn-success mt-2 w-100" name="uploadfile" value="Upload file" id="uploadfile"/>
        </form>
           
        </div>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">UPLOADED DOCUMENTS</li>
  </ol>
</nav>
<div class="row justify-content-center">
<?php
$select = "select * from usersDocument where UId=".base64_decode($id);
if($res = mysqli_query($con, $select)){
  if(mysqli_num_rows($res) != 0){
    while($row = mysqli_fetch_array($res)){
      ?>
      <div class="card border-0 w-0 col-3 col-md-3 col-lg-3 col-xl-3 m-2 text-center">
      <a href="../php/viewdoc?filename=<?php echo base64_encode($row[2]); ?>" target="_blank"><img src="../assets/images/icons/pdf.svg" class="w-100"/></a>
      <a href="../php/deletedocs?rawvalue=<?php echo $val; ?>&doctype=<?php echo base64_encode($row[1]); ?>&filename=<?php echo $row[2]; ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete it?')">Delete</a>
      <p class="text-secondary text-center mt-3"><?php if($row[1] == "cv"){ echo "CV"; }else if($row[1] == "ec"){ echo "Experience Certificate"; }else{ echo "Internship / Course Certificate"; } ?></p>
    </div>
      <?php
    }
  }else{
    ?>
<img src="../assets/images/icons/notfound.svg" width="30%"/>
<p class="w-100 text-center h3 m-3 text-secondary">No data found</p>
    <?php
  }
}
?>
</div>
        </div>
      </div>
       </div>



    <!-- <script src="../js/jquery.dm-uploader.min.js"></script> -->
    <script src="../js/jquery.min.js"></script>

   

    <script>

$(document).ready(function () {
  $('#choosefile').prop('disabled', true);
  $('#uploadfile').prop('disabled', true);
  $('#doctype').on('change', function(){
    $('#choosefile').prop('disabled', false);
    $('#choosefile').click(function(){
    $('#file').click();
});
    $('#file').on('change', function(){
  $('#uploadfile').prop('disabled', false);
    })
  })
    });
 
      </script>
  </body>
</html>


<?php
        }
    }
}
?>