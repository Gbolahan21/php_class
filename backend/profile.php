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

    $firstname = trim($_POST["firstname"]);
    $lastname  = trim($_POST["lastname"]);
    $password  = trim($_POST["password"]);
    $cpassword = trim($_POST["cpassword"]);

    // Validate names
    if (empty($firstname) || empty($lastname)) {
        header("Location: ../dashboard.php?message=First name and last name are required");
        exit;
    }

    // Get current user
    $stmt = mysqli_prepare($db_connect, "SELECT image FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    $imageName = $user["image"];

    // =========================
    // IMAGE UPLOAD (OPTIONAL)
    // =========================
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

        $fileName = $_FILES["file"]["name"];
        $tmpName  = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];

        if ($fileSize > 2 * 1024 * 1024) {
            header("Location: ../dashboard.php?message=Image must be less than 2MB");
            exit;
        }

        $allowedExt = ["jpg", "jpeg", "png"];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExt)) {
            header("Location: ../dashboard.php?message=Only JPG, JPEG and PNG images are allowed");
            exit;
        }

        $newImageName = uniqid() . "." . $extension;

        if (!move_uploaded_file($tmpName, "../uploads/" . $newImageName)) {
            header("Location: ../dashboard.php?message=Failed to upload image");
            exit;
        }

        $imageName = $newImageName;
    }

    // =========================
    // PASSWORD VALIDATION
    // =========================

    if (!empty($password)) {

        if (strlen($password) < 8) {
            header("Location: ../dashboard.php?message=Password must be at least 8 characters");
            exit;
        }

        if ($password !== $cpassword) {
            header("Location: ../dashboard.php?message=Passwords do not match");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $db_connect,
            "UPDATE users
            SET firstname=?, lastname=?, password=?, image=?
            WHERE email=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $firstname,
            $lastname,
            $hashedPassword,
            $imageName,
            $email
        );

    } else {

        // User didn't change password

        $stmt = mysqli_prepare(
            $db_connect,
            "UPDATE users
            SET firstname=?, lastname=?, image=?
            WHERE email=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $firstname,
            $lastname,
            $imageName,
            $email
        );
    }

    if (mysqli_stmt_execute($stmt)) {

        header("Location: ../dashboard.php?success=Profile updated successfully");

    } else {

        header("Location: ../dashboard.php?message=Failed to update profile");

    }

    exit;

?>