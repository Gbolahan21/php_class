<?php

include "../connect/connect.php";

session_start();

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($email) || empty($password)) {
    header("Location: ../signin.php?message=Please enter your credentials");
    exit;
}

$stmt = mysqli_prepare($db_connect, "SELECT * FROM admins WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {

        $_SESSION['email'] = $user['email'];

        if (isset($_POST['remember'])) {
            setcookie("email", $user['email'], time() + (86400 * 30), "/");
        }

        header("Location: ../dashboard.php");
        exit;

    } else {

        header("Location: ../signin.php?message=Invalid password");
        exit;
    }

} else {

    header("Location: ../signin.php?message=Email does not exist");
    exit;
}