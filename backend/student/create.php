<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include "../../connect/connect.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: ../../students.php");
        exit;
    }

    // Collect form data
    $matric_no = trim($_POST["matric_no"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $gender = trim($_POST["gender"]);
    $department = trim($_POST["department"]);
    $level = trim($_POST["level"]);
    $status = trim($_POST["status"]);

    // Basic validation
    if (
        empty($matric_no) ||
        empty($firstname) ||
        empty($lastname) ||
        empty($email) ||
        empty($phone) ||
        empty($gender) ||
        empty($department) ||
        empty($level) ||
        empty($status)
    ) {
        header("Location: ../../students.php?message=Please fill in all required fields");
        exit;
    }

    $stmt = mysqli_prepare(
        $db_connect,
        "SELECT id FROM students WHERE matric_no = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $matric_no);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        header("Location: ../../students.php?message=Student ID already exists");
        exit;

    }

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare(
        $db_connect,
        "SELECT id FROM students WHERE email = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        header("Location: ../../students.php?message=Email already exists");
        exit;

    }

    mysqli_stmt_close($stmt);

    $imageName = "";

    if (
        isset($_FILES["image"]) &&
        $_FILES["image"]["error"] === UPLOAD_ERR_OK
    ) {

        $extension = strtolower(
            pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)
        );

        $allowed = ["jpg", "jpeg", "png", "webp"];

        if (!in_array($extension, $allowed)) {

            header("Location: ../../students.php?message=Invalid image format");
            exit;

        }

        $imageName = uniqid("student_", true) . "." . $extension;

        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            "../../uploads/students/" . $imageName
        );
    }

    $stmt = mysqli_prepare(
        $db_connect,
        "INSERT INTO students
        (
            matric_no,
            firstname,
            lastname,
            email,
            phone,
            gender,
            department,
            level,
            status,
            image
        )
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssss",
        $matric_no,
        $firstname,
        $lastname,
        $email,
        $phone,
        $gender,
        $department,
        $level,
        $status,
        $imageName
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: ../../students.php?success=Student added successfully");

    } else {

        header("Location: ../../students.php?message=Unable to add student");

    }

    mysqli_stmt_close($stmt);
    mysqli_close($db_connect);

    exit;
?>