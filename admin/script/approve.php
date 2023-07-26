<?php 
session_start();
require '../../connection.php';


if(isset($_GET['usermatric'])){
    $current_matric = $_GET['usermatric'];
    $status = $_GET['userstatus'];
    $request = $_GET['userrequest'];

    if($status == 'notapproved' && $request == '1'){
        $sql = "UPDATE `user` SET `status` = 'Approved' WHERE `matric_number` = '$current_matric'";
        $approveRequest = mysqli_query($conn, $sql);
        header('location: ../allrequest.php');
    }

    if($status == 'Approved'){
        $sql = "UPDATE `user` SET `status` = 'notapproved' WHERE `matric_number` = '$current_matric'";
        $approveRequest = mysqli_query($conn, $sql);
        header('location: ../allrequest.php');
    }    
}

else{
    echo "Error approving a user";
}


?>