<?php
    require 'connection.php';
    session_start();
    
    if(isset($_POST['login'])){
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        $success = "Welcome";
        $error = "Password or Matric is not correct";

        $sql = "SELECT * FROM `user` WHERE `matric_number` = '$matric' AND `password` = '$password'";

        $userLogin = mysqli_query($conn, $sql);

        if($userLogin && mysqli_num_rows($userLogin) > 0){
            $_SESSION['success'] = $success;
            $_SESSION['matric'] = $matric;
            header('location: user/dashboard.php');
        } else{
            $_SESSION['error'] = $error;
            header('location: index.php');
        }
    }
?>