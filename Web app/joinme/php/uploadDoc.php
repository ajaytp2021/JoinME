<?php
require 'con.php';
require '../global/global.php';
require 'server/server.php';
session_start();
$val = $_GET['rawvalue'];
        if($con){
            if(isset($_POST['uploadfile'])){
            $type = $_POST['doctype'];
            if(!empty($_FILES) && isset($_FILES['pdf'])){
                $pdf = generateRandomStringDocs().".pdf";
                $pdfloc = $_FILES['pdf']['tmp_name'];
            }else{
                echo "error no file";
            }
            $id = base64_decode($_SESSION['uid']);
            $upload = "insert into usersDocument values($id, '$type', '$pdf')";
            $check = "select * from usersDocument where UId=$id and type='$type'";
            if($res = mysqli_query($con, $check)){
                if(mysqli_num_rows($res) == 0){
                    if(uploadPdfDoc($con, $pdf, $pdfloc)){
                        if(mysqli_query($con, $upload)){
                            echo "<script>
                    window.alert('Document uploaded successfully')
                    window.location.href='".$host."/User/documents.php?rawvalue=$val'
                    </script>";
                        }else{
                            echo "insert error";

                        }
                    }else{
                        echo "upload error";
                    }
                }else{
                    echo "<script>
                    window.alert('You already uploaded!')
                    window.location.href='".$host."/User/documents.php?rawvalue=$val'
                    </script>";
                }
            }else{
                echo "first query error";
            }
        }
        }
?>