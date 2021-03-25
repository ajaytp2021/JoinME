<?php
require '../php/con.php';
require '../php/server/server.php';
if($con){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="../js/jquery.js"></script>
<link rel="stylesheet" href="../css/bootstrap.css" />
<link rel="javascript" href="../js/bootstrap.js" />
    <link rel="stylesheet" href="../css/mycss.css" />
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
                    <form action="../php/register" method="POST" name="registerform" class="row w-100 align-items-center mx-auto justify-content-center" enctype="multipart/form-data" onsubmit="return registerCheck();">
                        <p class="text-center font-weight-bold col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">Company Registration</p>
                        
                        <div class="form-group has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                            <center><img src="../assets/images/addlogo.png" class="rounded img-fluid logo" alt="You Logo" id="logo" style="clip-path: circle(50% at 50% 50%);" width="200px"></center>
                        </div>
                        <div class="form-group col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <center><input type="button" id="upload_link" value="Choose logo" class="btn btn-primary"><input class="form-control" name="img" style="display: none;" id="selectlogo" type="file" accept="image/x-png,image/jpeg" data-toggle="popover" title="Popover title"><center>
                        <p class="text-center w-100 text-secondary">Logo should be in square<span class="text-danger">&nbsp;*</span></p>
                            </div>

                       
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Username</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="Username" aria-describedby="basic-addon1" name="uname" id="uname">
                            <div class="invalid-feedback" id="erruname"></div>
                        </div>

                        <div class="input-group mb-2 col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Company Name</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="Company Name" aria-describedby="basic-addon1" name="cname" id="cname">
                            <div class="invalid-feedback" id="errcname"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Password</span>
  </div>
                            <input type="password" class="form-control" placeholder="Enter here" aria-label="Password" aria-describedby="basic-addon1" name="pass" id="pass">
                            <div class="invalid-feedback" id="errpass"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Re-password</span>
  </div>
                            <input type="password" class="form-control" placeholder="Enter here" aria-label="Repeat Password" aria-describedby="basic-addon1" name="rpass" id="rpass">
                            <div class="invalid-feedback" id="errrpass"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Phone</span>
  </div>
                            <input type="number" class="form-control" placeholder="Enter here" aria-label="Phone" aria-describedby="basic-addon1" name="phone" id="phone">
                            <div class="invalid-feedback" id="errphone"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Email</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="Email" aria-describedby="basic-addon1" name="email" id="email">
                            <div class="invalid-feedback" id="erremail"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Company Start?</span>
  </div>
                            <input type="text" class="form-control" placeholder="Choose date" aria-label="Company started since" aria-describedby="basic-addon1" onfocus="(this.type='date')" onblur="(this.type='text')" name="csdate" id="csdate">
                            <div class="invalid-feedback" id="errsdate"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Pincode</span>
  </div>
                            <input type="number" class="form-control" placeholder="Enter here" aria-label="Pincode" aria-describedby="basic-addon1" name="pincode" id="pincode">
                            <div class="invalid-feedback" id="errpincode"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Address</span>
  </div>
                        <textarea class="form-control" aria-label="With textarea" placeholder="Enter here" name="address" rows="4" id="addr"></textarea>
                        <div class="invalid-feedback" id="erraddr"></div>
                        </div>
                        
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">District</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="District" aria-describedby="basic-addon1" name="district" id="district">
                            <div class="invalid-feedback" id="errdistrict"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">State</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="State" aria-describedby="basic-addon1" name="state" id="state">
                            <div class="invalid-feedback" id="errstate"></div>
                        </div>
                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Country</span>
  </div>
                            <input type="text" class="form-control" placeholder="Enter here" aria-label="Country" aria-describedby="basic-addon1" name="country" id="country">
                            <div class="invalid-feedback" id="errcntry"></div>
                        </div>

                        <div class="input-group mb-2 has-error has-feedback col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 w-100">
                        <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">About your company</span>
  </div>
                        <textarea class="form-control" aria-label="About your company" rows="8" placeholder="Enter here" name="about" id="about"></textarea>
                        <div class="invalid-feedback" id="errabout"></div>
                        </div>

                        <!-- <div class="" -->
                        
                        <div class="form-group w-100 col-centered mx-auto col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 justify-content-center align-items-lg-center">
                        
                        <center><input type="submit" name="registerCompany" class="btn btn-primary" value="Register" id="regcompany"/></center>
                        </div>
                        <div class="form-group w-100 col-centered mx-auto col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                         
                       <center> <a href="<?php  echo $host; ?>/joinme/Company/login">Back to login</a></center>
                        </div>
                    
                    </form>
                </div>
            </div>
    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2 col-1"></div>
    </div>

    </div>
</div>
</body>

<script>


$(document).ready(function(){


    var uname = false;
    var cname = false;
    var pass = false;
    var phone = false;
    var email = false;
    var sdate = false;
    var pincode = false;
    var addr = false;
    var dist = false;
    var state = false;
    var country = false;
    var about = false;

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

    $('#cname').on('keyup', function(){
        if($('#cname').val().length < 5){
            cname = false;
            if(!$('#cname').hasClass("is-invalid")){
                $('#cname').addClass("is-invalid");
            }
            $('#errcname').html("Company Name atleast 5 characters");
        }else{
            cname = true;
            $('#cname').removeClass("is-invalid");
            if(!$('#cname').hasClass("is-valid")){
                $('#cname').addClass("is-valid");
            }
            $('#errcname').html("");
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
        isFinished();
    })

    $('#rpass').on('keyup', function(){
        if($('#rpass').val().length != 0){
        if($('#rpass').val() != $('#pass').val()){
            pass = false;
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
            pass = false;
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

    $('#csdate').on('change', function(){
        if(!isValidDate($('#csdate').val())){
            cdate = false;
            if(!$('#csdate').hasClass("is-invalid")){
                $('#csdate').addClass("is-invalid");
            }
            $('#errsdate').html("csdateword must be 8 characters");
        }else{
            cdate = true;
            $('#csdate').removeClass("is-invalid");
            if(!$('#csdate').hasClass("is-valid")){
                $('#csdate').addClass("is-valid");
            }
            $('#errsdate').html("");
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
        if($('#district').val().length == 0){
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
    if(uname && name && pass && phone && email && cdate && addr && pincode && dist && state && country && about){
        $('#regcompany').prop("disabled", false);
    }else{
        $('#regcompany').prop("disabled", true);
    }
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
})

    </script>
<script>

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
                alert('This logo is not sqaure. Please make your image square.')
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

<?php } ?>