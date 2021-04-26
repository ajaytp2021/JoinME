<?php

function getName($con, $type, $id){
if($con){
    $id = base64_decode($id);
    $type == "users" ? $idtype = "UId" : $idtype = "CId";
    $type == "users" ? $nametype = "name" : $nametype = "cname";
    $name = "select $nametype from $type where $idtype=$id";
    if($res = mysqli_query($con, $name)){
        while($row = mysqli_fetch_array($res)){
            echo $row[0];
        }
    }
}
}