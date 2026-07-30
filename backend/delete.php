<?php

include "../connect/connect.php";

session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../signin.php?message=Please login first");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../dashboard.php");
    exit;
}

$email = $_SESSION["email"];

// Prepare delete statement
$stmt = mysqli_prepare($db_connect, "DELETE FROM admins WHERE email = ?");

if (!$stmt) {
    header("Location: ../dashboard.php?message=Database error");
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $email);

if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {

    // Close statement
    mysqli_stmt_close($stmt);

    // Clear session
    $_SESSION = [];
    session_destroy();

    // Remove Remember Me cookie
    setcookie("email", "", time() - 3600, "/");

    header("Location: ../signin.php?message=Account deleted successfully");
    exit;

} else {

    mysqli_stmt_close($stmt);

    header("Location: ../dashboard.php?message=Unable to delete account");
    exit;
}