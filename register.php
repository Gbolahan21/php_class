<?php

    include "connect.php";
    
    if (!$email || !$password){
        header("Location: index.php?message=Please Enter your credentials");   
    } else {
        // image upload handling
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
                header("Location: index.php?upload_error=No file uploaded");
                exit;
            }

            $pem_file = $_FILES['file']['name'];
            $tmp_file = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];

            if ($size > 2000000) {
                header("Location: index.php?upload_error=File too large");
                exit;
            }

            $allowed_ext = ['jpeg', 'jpg', 'png'];
            $file_extension = strtolower(pathinfo($pem_file, PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_ext)) {
                header("Location: index.php?upload_error=Invalid file extension");
                exit;
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmp_file);

            if (!in_array($mime, ['image/jpeg', 'image/png'])) {
                header("Location: index.php?upload_error=Invalid file type");
                exit;
            }

            $new_file_name = uniqid() . "." . $file_extension;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($tmp_file, "uploads/" . $new_file_name)) { 
                // check if the email exist
                $check_email = mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$email'");

                if (mysqli_num_rows($check_email) > 0) {
                    header("Location: index.php?message=Email already exists");
                    exit;
                }  
                
                $query = mysqli_query($db_connect, "INSERT INTO `users` (`name`, `email`, `password`, `image`) VALUES ('$name', '$email', '$password', '$new_file_name')");
                
                if (!$query) { 
                    header("Location: index.php?message='Failed to create user'");
                    exit;
                }

                header("Location: indexlogin.php");
                exit;
            } else {
                header("Location: index.php?upload_error=Upload failed");
                exit;
            }
        }
    }
?>