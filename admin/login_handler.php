<?php
session_start();
require '../connection.php';
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $success = "Welcome Admin";
        $error = "Error login in";
        
        $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";

        $userLogin = mysqli_query($conn, $sql);

        if($userLogin && mysqli_num_rows($userLogin) > 0){
            $_SESSION['success'] = $success;
            $_SESSION['username'] = $username;
            header('location: dashboard.php');
        } else{
            $_SESSION['error'] = $error;
            header('location: index.php');
        }
    }
?>