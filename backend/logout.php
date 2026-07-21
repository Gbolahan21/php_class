<?php
    session_start();

    // Clear all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Remove the remember-me cookie if it exists
    if (isset($_COOKIE['email'])) {
        setcookie("email", "", time() - 3600, "/");
    }

    // Redirect to the sign-in page
    header("Location: ../signin.php");
    exit();
?>