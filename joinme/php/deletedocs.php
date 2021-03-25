<?php
require 'con.php';
require 'server/server.php';
session_start();
error_reporting(E_ALL);

    isset($_GET["rawvalue"]) ? $val = $_GET["rawvalue"] : $val = "";
    isset($_SESSION['uid']) ? $id = $_SESSION['uid'] : $id = "";
    $doctype = $_GET["doctype"];
    $filename = $_GET["filename"];
if(!isset($_SESSION["loginuser"]) && empty($_SESSION["loginuser"])){
    header("Location: ".$host."/joinme/User/login");
}else{
    if($_SESSION["loginuser"] != $val){
        echo "You're trying to enter illegally. This attempt will be reported";
    }else{
        if($con){
          $delete = "delete from usersDocument where UId=".base64_decode($id)." and type='".base64_decode($doctype)."'";
          $check = "select * from usersDocument where UId=".base64_decode($id)." and type='".base64_decode($doctype)."'";
          if(unlink('../assets/users/docs/files/'.$filename)){

          if(mysqli_query($con, $delete)){
              if($res = mysqli_query($con, $check)){
                  if(mysqli_num_rows($res) == 0){
                      echo '<script>
                      window.alert("Successfully deleted")
                      window.location.href="../User/documents?rawvalue='.$val.'"
                      </script>
                      ';
                  }
              }
          }else{
              echo mysqli_error($con);
          }
        }else{
            echo "File not deleted";
        }

        }
    }
}
        
?>