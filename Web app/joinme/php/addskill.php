<?php
require 'con.php';
require 'server/server.php';
session_start();
if(isset($_POST['addskillbtn'])){

    $val = $_SESSION["login"];
    $skill = $_POST['skill'];
    if(!empty($skill)){
    $skill = strtoupper($skill);
    $check = "select * from skills where skill='$skill'";
    $addskill = "insert into skills(`skill`) values('$skill')";
    if($res = mysqli_query($con, $check)){
        if(mysqli_num_rows($res) > 0){
            echo '<script>window.alert("This skill has already inserted");
            window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'";
            </script>';
        }else{
            if(mysqli_query($con, $addskill)){
                echo '<script>
                window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'";
                </script>';
            }else{
                echo '<script>window.alert("Query error");
                window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'";
                </script>';
            }
        }
    }else{
        echo '<script>window.alert("Query error check");
        window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'";
        </script>';
    }
}else{
    echo '<script>window.alert("Empty value entered");
    window.location="'.$host.'/Admin/addskills.php?rawvalue='.$val.'";
    </script>';
}
}
?>