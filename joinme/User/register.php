<?php require '../php/server/server.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/mycss.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/formValidation.min.css" />
    <link rel="javascript" href="../js/bootstrap.js" />
    <link rel="javascript" href="../js/formValidation.js" />
    <script src="../js/jquery.js"></script>
    <script src="../js/formValidation.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-image: url('../assets/images/icons/loadingbg.svg')">
    <div class="container h-100">
    
    <div class="row align-items-center h-100">
    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2 col-1"></div>
    <div class="d-inline-flex p-2 col-lg-8 col-md-10 col-sm-8 col-xl-8 col-10">
                <div class="card-body">
                    <div id="msg"></div>
                    <form action="../php/register" method="POST" name="registerform" class="row w-100 align-items-center mx-auto justify-content-center" autocomplete="off" enctype="multipart/form-data" onsubmit="return registerCheck();">
                        <p class="text-center font-weight-bold col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">User Registration</p>
                        
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                            <center><img src="../assets/images/man.png" class="rounded img-fluid logo" alt="You Logo" id="logo" style="clip-path: circle(50% at 50% 50%);" width="20%" height="20%"></center>
                        </div>
                        <div class="form-group col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <center><input type="button" id="upload_link" value="Choose your photo" class="btn btn-primary"><input class="form-control" name="img" style="display: none;" id="selectlogo" type="file" accept="image/x-png,image/jpeg" data-toggle="popover" title="Popover title"><center>
                        <p class="text-center w-100 text-secondary">Image should be in square<span class="text-danger">&nbsp;*</span></p>
                            </div>

                       
                        
                            <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Username</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter Username" aria-label="Username" aria-describedby="basic-addon1" name="uname" id="uname">
                        <div class="invalid-feedback" id="erruname"></div>
                        </div>

                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Full Name</span>
  </div><input type="text" class="form-control" placeholder="Enter Full name" aria-label="Name" aria-describedby="basic-addon1" name="name" id="name">
  <div class="invalid-feedback" id="errname"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Password</span>
  </div>
                        <input type="password" class="form-control" placeholder="Enter Password" aria-label="Password" aria-describedby="basic-addon1" name="pass" id="pass">
                        <div class="invalid-feedback" id="errpass"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Re-password</span>
  </div>
                        <input type="password" class="form-control" placeholder="Enter password again" aria-label="Repeat Password" aria-describedby="basic-addon1" name="rpass" id="rpass">
                        <div class="invalid-feedback" id="errrpass"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Phone</span>
  </div>
                        <input type="number" class="form-control" placeholder="Enter Phone number" aria-label="Phone" aria-describedby="basic-addon1" name="phone" id="phone">
                        <div class="invalid-feedback" id="errphone"></div>
                        </div>
                        
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Email</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter Email" aria-label="Email" aria-describedby="basic-addon1" name="email" id="email" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" id="email" onchange="">
                        <div class="invalid-feedback" id="erremail"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Gender</span>
  </div>
                        <select class="form-control" name="gender" id="gender"><option disabled selected>Gender</option><option value="male">Male</option><option value="female">Female</option></select>
                        <div class="invalid-feedback" id="errgender"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Date of birth</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter Date of birth" aria-label="DOB" aria-describedby="basic-addon1" onfocus="(this.type='date')" onblur="(this.type='text')" name="dob" id="dob">
                        <div class="invalid-feedback" id="errdob"></div>
                        </div>
                       
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Address</span>
  </div>
                        <textarea class="form-control" aria-label="With textarea" placeholder="Enter Address" id="addr" name="address" rows="4"></textarea>
                        <div class="invalid-feedback" id="erraddr"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Pincode</span>
  </div>
                        <input type="number" class="form-control" placeholder="Enter Pincode" aria-label="Pincode" aria-describedby="basic-addon1" name="pincode" id="pincode">
                        <div class="invalid-feedback" id="errpincode"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">District</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter District" aria-label="District" aria-describedby="basic-addon1" name="district" id="district">
                        <div class="invalid-feedback" id="errdistrict"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">State</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter State" aria-label="State" aria-describedby="basic-addon1" name="state" id="state">
                        <div class="invalid-feedback" id="errstate"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Country</span>
  </div>
                        <input type="text" class="form-control" placeholder="Enter Country" aria-label="Country" aria-describedby="basic-addon1" name="country" id="country">
                        <div class="invalid-feedback" id="errcountry"></div>
                        </div>

                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">About yourself</span>
  </div><textarea class="form-control" aria-label="Enter any thing about youself" rows="8" placeholder="About yourself" name="about" id="about"></textarea>
  <div class="invalid-feedback" id="errabout"></div>
                        </div>

                        <!-- <div class="" -->
                        
                        <div class="form-group w-100 col-centered mx-auto col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 justify-content-center align-items-lg-center">
                        
                       <center><input type="submit" name="registerUser" class="btn btn-primary" value="Register" id="reguser"/></center>
                       </div>
                       <div class="form-group w-100 col-centered mx-auto col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        
                      <center> <a href="<?php echo $host; ?>/joinme/User/login">Back to login</a></center>
                       </div>
                       
                    
                    </form>
                </div>
            </div>
    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2 col-1"></div>
    </div>

    </div>
</body>
<script>

$(document).ready(function(){

    var uname = false;
    var name = false;
    var pass = false;
    var phone = false;
    var email = false;
    var gender = false;
    var dob = false;
    var pincode = false;
    var addr = false;
    var dist = false;
    var state = false;
    var country = false;
    var about = false;

    $('#reguser').prop("disabled", true);

    $('#uname').on('keyup', function(){
        if($('#uname').val().length < 5){
            uname = false;
            if(!$('#uname').hasClass("is-invalid")){
                $('#uname').addClass("is-invalid");
            }
            $('#erruname').html("Username atleast 5 characters");
        }else{
            uname = true;
            $('#uname').removeClass("is-invalid");
            if(!$('#uname').hasClass("is-valid")){
                $('#uname').addClass("is-valid");
            }
            $('#erruname').html("");
        }
        isFinished();
    })

    $('#name').on('keyup', function(){
        if($('#name').val().length < 3){
            name = false;
            if(!$('#name').hasClass("is-invalid")){
                $('#name').addClass("is-invalid");
            }
            $('#errname').html("Name atleast 3 characters");
        }else{
            name = true;
            $('#name').removeClass("is-invalid");
            if(!$('#name').hasClass("is-valid")){
                $('#name').addClass("is-valid");
            }
            $('#errname').html("");
        }
        isFinished();
    })

    $('#pass').on('keyup', function(){
        if($('#pass').val().length < 8){
            if(!$('#pass').hasClass("is-invalid")){
                $('#pass').addClass("is-invalid");
            }
            $('#errpass').html("Password must be 8 characters");
        }else{
            $('#pass').removeClass("is-invalid");
            if(!$('#pass').hasClass("is-valid")){
                $('#pass').addClass("is-valid");
            }
            $('#errpass').html("");
        }
    })

    $('#rpass').on('keyup', function(){
        if($('#rpass').val().length != 0){
            pass = false;
        if($('#rpass').val() != $('#pass').val()){
            if(!$('#rpass').hasClass("is-invalid")){
                $('#rpass').addClass("is-invalid");
            }
            $('#errrpass').html("Password doesn't match");
        }else{
            pass = true;
            $('#rpass').removeClass("is-invalid");
            if(!$('#rpass').hasClass("is-valid")){
                $('#rpass').addClass("is-valid");
            }
            $('#errrpass').html("");
        }
        }else{
            if(!$('#rpass').hasClass("is-invalid")){
                $('#rpass').addClass("is-invalid");
            }
            $('#errrpass').html("Password doesn't match");
        }
        isFinished();
    })

    $('#phone').on('keyup', function(){
        if($('#phone').val().length != 10){
            phone = false;
            if(!$('#phone').hasClass("is-invalid")){
                $('#phone').addClass("is-invalid");
            }
            $('#errphone').html("Phone number must be 10 digits");
        }else{
            if(validatePhone($('#phone').val())){
                phone = true;
            $('#phone').removeClass("is-invalid");
            if(!$('#phone').hasClass("is-valid")){
                $('#phone').addClass("is-valid");
            }
            $('#errphone').html("");
            }else{
                phone = false;
                $('#phone').removeClass("is-valid");
                if(!$('#phone').hasClass("is-invalid")){
                $('#phone').addClass("is-invalid");
            }
            $('#errphone').html("Enter valid phone number");
            }
        }
        isFinished();
    })

    $('#email').on('keyup', function(){

        if(!isEmail($('#email').val())){
            email = false;
            if(!$('#email').hasClass("is-invalid")){
                $('#email').addClass("is-invalid");
            }
            $('#erremail').html("Enter a valid email");
        }else{
            email = true;
            $('#email').removeClass("is-invalid");
            if(!$('#email').hasClass("is-valid")){
                $('#email').addClass("is-valid");
            }
            $('#erremail').html("");
        }
        isFinished();
    })

    $('#gender').on('change', function(){
        if($('#gender').val() == null){
            gender = false;
            if(!$('#gender').hasClass("is-invalid")){
                $('#gender').addClass("is-invalid");
            }
            $('#errsdate').html("Choose gender");
        }else{
            gender = true;
            $('#gender').removeClass("is-invalid");
            if(!$('#gender').hasClass("is-valid")){
                $('#gender').addClass("is-valid");
            }
            $('#errgender').html("");
        }
        isFinished()
    })

    $('#dob').on('change', function(){
        if(!isValidDate($('#dob').val())){
            dob = false;
            if(!$('#dob').hasClass("is-invalid")){
                $('#dob').addClass("is-invalid");
            }
            $('#errsdate').html("Choose date");
        }else{
            dob = true;
            $('#dob').removeClass("is-invalid");
            if(!$('#dob').hasClass("is-valid")){
                $('#dob').addClass("is-valid");
            }
            $('#errdob').html("");
        }
        isFinished();
    })

    $('#pincode').on('keyup', function(){
        if($('#pincode').val().length != 6){
            pincode = false;
            if(!$('#pincode').hasClass("is-invalid")){
                $('#pincode').addClass("is-invalid");
            }
            $('#errpincode').html("Enter a valid pincode");
        }else{
            pincode = true;
            $('#pincode').removeClass("is-invalid");
            if(!$('#pincode').hasClass("is-valid")){
                $('#pincode').addClass("is-valid");
            }
            $('#errpincode').html("");
        }
        isFinished();
    })

    $('#addr').on('keyup', function(){
        if($('#addr').val().length < 10){
            addr = false;
            if(!$('#addr').hasClass("is-invalid")){
                $('#addr').addClass("is-invalid");
            }
            $('#erraddr').html("Your address should more than 10 characters");
        }else{
            addr = true;
            $('#addr').removeClass("is-invalid");
            if(!$('#addr').hasClass("is-valid")){
                $('#addr').addClass("is-valid");
            }
            $('#erraddr').html("");
        }
        isFinished();
    })

    $('#district').on('keyup', function(){
        if($('#district').val().length == 0 && !character($('#district').val())){
            dist = false;
            if(!$('#district').hasClass("is-invalid")){
                $('#district').addClass("is-invalid");
            }
            $('#errdistrict').html("Enter your district");
        }else{
            dist = true;
            $('#district').removeClass("is-invalid");
            if(!$('#district').hasClass("is-valid")){
                $('#district').addClass("is-valid");
            }
            $('#errdistrict').html("");
        }
        isFinished();
    })

    $('#state').on('keyup', function(){
        if($('#state').val().length == 0){
            state = false;
            if(!$('#state').hasClass("is-invalid")){
                $('#state').addClass("is-invalid");
            }
            $('#errstate').html("Enter your state");
        }else{
            state = true;
            $('#state').removeClass("is-invalid");
            if(!$('#state').hasClass("is-valid")){
                $('#state').addClass("is-valid");
            }
            $('#errstate').html("");
        }
        isFinished();
    })

    $('#country').on('keyup', function(){
        if($('#country').val().length == 0){
            country = false;
            if(!$('#country').hasClass("is-invalid")){
                $('#country').addClass("is-invalid");
            }
            $('#errcntry').html("Enter your country");
        }else{
            country = true;
            $('#country').removeClass("is-invalid");
            if(!$('#country').hasClass("is-valid")){
                $('#country').addClass("is-valid");
            }
            $('#errcountry').html("");
        }
        isFinished();
    })

    $('#about').on('keyup', function(){
        if($('#about').val().length < 100){
            about = false;
            if(!$('#about').hasClass("is-invalid")){
                $('#about').addClass("is-invalid");
            }
            $('#errabout').html("About must be atleast 100 characters");
        }else{
            about = true;
            $('#about').removeClass("is-invalid");
            if(!$('#about').hasClass("is-valid")){
                $('#about').addClass("is-valid");
            }
            $('#errabout').html("");
        }
        isFinished();
    })


    function isFinished(){
    if(uname && name && pass && phone && email && gender && dob && addr && pincode && dist && state && country && about){
        $('#reguser').prop("disabled", false);
    }else{
        $('#reguser').prop("disabled", true);
    }
}
    

function character(char) {
    var filter = /^[A-Za-z]{1,}$/;
    if (filter.test(char)) {
        return true;
    }
    else {
        return false;
    }
}

function isEmail(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

function isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  if(!dateString.match(regEx)) return false;  // Invalid format
  var d = new Date(dateString);
  var dNum = d.getTime();
  if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
  return d.toISOString().slice(0,10) === dateString;
}

function validatePhone(txtPhone) {
    var filter = /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/;
    if (filter.test(txtPhone)) {
        return true;
    }
    else {
        return false;
    }
}



});
    </script>
<script type="text/javascript">
// $(function(){
//     $("#upload_link").on('click', function(e){
//         e.preventDefault();
//         $("#upload:hidden").trigger('click');
//     });
// });

$('#upload_link').click(function(){
    $('#selectlogo').click();
});

var _URL = window.URL || window.webkitURL;
$("#selectlogo").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function () {
            if(this.width != this.height){
                alert('This image is not sqaure. Please make your image square.')
            }else{
                PreviewImage();
            }
            _URL.revokeObjectURL(objectUrl);
        };
        img.src = objectUrl;
    }
});

function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("selectlogo").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("logo").src = oFREvent.target.result;
        };
    };


</script>
</html>