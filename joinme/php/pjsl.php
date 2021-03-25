<?php
require 'con.php';
$level = "";
$id = 0;

if($con){
$val = $_GET['skill'];
    $select = "select levels from companySalaryScale where jTitle='$val'";
    if($res = mysqli_query($con, $select)){
        while($row = mysqli_fetch_array($res)){
            if($row[0] == 1){ $level = "Beginner"; $id = 1; };
            if($row[0] == 2){ $level = "Intermediate"; $id = 2; };
            if($row[0] == 3){ $level = "Expert"; $id = 3; };
            $arr[] = array("level" => $level, "id" => $id);
        }
        echo json_encode($arr);
    }

}

?>