<?php

    session_start();

    print_r($_POST);

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!$email || !$password){
        header("Location: index.php?message=Please Enter your credentials");   
    } else {

        $_SESSION['email'] = $email;

        if (isset($_POST['remember'])) {
            setcookie("email", $email, time() + (86400 * 30), "/");
        }

        header("Location: dashboard.php");
    }
?>