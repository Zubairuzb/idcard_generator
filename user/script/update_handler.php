<?php 
require '../../connection.php';
session_start();

if(!isset($_SESSION['matric'])){
    header('location: ../../index.php');
}



if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $gender = $_POST['gender'];
    $level = $_POST['level'];
    $current_matric = $_SESSION['matric']; 

    $passport = $_FILES['passport']['name'];
    $extension = explode(".", $passport);
    $newfilename = $matric.'.'.end($extension);
    
    $temp_name = $_FILES['passport']['tmp_name'];

    
    $path = "../../uploads/".$newfilename;

    $sql = "UPDATE `user` SET `fullname` = '$fullname', `matric_number` = '$matric', `gender` = '$gender', `level` = '$level', `passport` = '$path' WHERE `matric_number` = '$current_matric' ";

    $uploadtodb = move_uploaded_file($temp_name, $path);

    $update = mysqli_query($conn, $sql);

    if($update && $uploadtodb){
        echo "Record and Passport has been updated";
    }else{
        echo "Error";
    }
}

?>