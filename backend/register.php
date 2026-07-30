<?php

    include "../connect/connect.php";


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if (!$email || !$password){
        header("Location: ../signup.php?message=Please Enter your credentials");   
    } else {
        // image upload handling
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
                header("Location: ../signup.php?upload_error=No file uploaded");
                exit;
            }

            $pem_file = $_FILES['file']['name'];
            $tmp_file = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];

            if ($size > 2000000) {
                header("Location: ../signup.php?upload_error=File too large");
                exit;
            }

            $allowed_ext = ['jpeg', 'jpg', 'png'];
            $file_extension = strtolower(pathinfo($pem_file, PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_ext)) {
                header("Location: ../signup.php?upload_error=Invalid file extension");
                exit;
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmp_file);

            if (!in_array($mime, ['image/jpeg', 'image/png'])) {
                header("Location: ../signup.php?upload_error=Invalid file type");
                exit;
            }

            $new_file_name = uniqid() . "." . $file_extension;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($tmp_file, "../uploads/" . $new_file_name)) { 
                // check if the email exist
                $stmt = mysqli_prepare($db_connect, "SELECT id FROM admins WHERE email = ?");
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    header("Location: ../signup.php?message=Email already exists");
                    exit;
                }

                if ($password !== $cpassword) {
                    header("Location: ../signup.php?message=Passwords do not match");
                    exit;
                }

                // First name
                if (empty($firstname)) {
                    header("Location: ../signup.php?message=First name is required");
                    exit;
                }

                // Last name
                if (empty($lastname)) {
                    header("Location: ../signup.php?message=Last name is required");
                    exit;
                }

                // Email
                if (empty($email)) {
                    header("Location: ../signup.php?message=Email is required");
                    exit;
                }

                // Valid email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../signup.php?message=Invalid email address");
                    exit;
                }

                // Password length
                if (strlen($password) < 8) {
                    header("Location: ../signup.php?message=Password must be at least 8 characters");
                    exit;
                }

                // Uppercase
                if (!preg_match('/[A-Z]/', $password)) {
                    header("Location: ../signup.php?message=Password must contain an uppercase letter");
                    exit;
                }

                // Lowercase
                if (!preg_match('/[a-z]/', $password)) {
                    header("Location: ../signup.php?message=Password must contain a lowercase letter");
                    exit;
                }

                // Number
                if (!preg_match('/[0-9]/', $password)) {
                    header("Location: ../signup.php?message=Password must contain a number");
                    exit;
                }

                // Special character
                if (!preg_match('/[\W_]/', $password)) {
                    header("Location: ../signup.php?message=Password must contain a special character");
                    exit;
                }

                // Confirm password
                if ($password !== $cpassword) {
                    header("Location: ../signup.php?message=Passwords do not match");
                    exit;
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $stmt = mysqli_prepare(
                    $db_connect,
                    "INSERT INTO admins (firstname, lastname, email, password, image)
                    VALUES (?, ?, ?, ?, ?)"
                );

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssss",
                    $firstname,
                    $lastname,
                    $email,
                    $hashedPassword,
                    $new_file_name
                );

                $query = mysqli_stmt_execute($stmt);

                if (!$query) {
                    die(mysqli_error($db_connect));
                }

                header("Location: ../signin.php");
                exit;
            } else {
                header("Location: ../signup.php?upload_error=Upload failed");
                exit;
            }
        }
    }
?>