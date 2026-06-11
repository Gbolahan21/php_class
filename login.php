<?php

    include "connect.php";

    session_start();

    $email = $_POST["email"];
    $password = $_POST["password"];
    $image = $_POST["image"];

    if (!$email || !$password){
        header("Location: indexlogin.php?message=Please Enter your credentials");   
    } else {
        // image upload handling
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            // check if the email exist
            $check_email = mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$email' AND password = '$password' ");

            if (mysqli_num_rows($check_email) > 0) {
                // email and password handling
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;
                
                if (isset($_POST['remember'])) {
                    setcookie("email", $email, time() + (86400 * 30), "/");
                }
                
                header("Location: dashboard.php");
                exit;
            }  else {

                header("Location: indexlogin.php?message=invalid credentials");
                exit;
            }
                
        }
    }
?>