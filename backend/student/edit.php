<?php

include "../../connect/connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../students.php");
    exit;
}

$id = (int) $_POST["id"];

$matric_no = trim($_POST["matric_no"]);
$firstname = trim($_POST["firstname"]);
$lastname = trim($_POST["lastname"]);
$email = trim($_POST["email"]);
$gender = trim($_POST["gender"]);
$department = trim($_POST["department"]);
$level = trim($_POST["level"]);
$status = trim($_POST["status"]);

if (
    empty($id) ||
    empty($matric_no) ||
    empty($firstname) ||
    empty($lastname) ||
    empty($email) ||
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
    "UPDATE students
     SET matric_no = ?,
         firstname = ?,
         lastname = ?,
         email = ?,
         gender = ?,
         department = ?,
         level = ?,
         status = ?
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssi",
    $matric_no,
    $firstname,
    $lastname,
    $email,
    $gender,
    $department,
    $level,
    $status,
    $id
);

if (mysqli_stmt_execute($stmt)) {

    header("Location: ../../students.php?success=Student updated successfully");
    exit;

}

header("Location: ../../students.php?message=Unable to update student");
exit;
?>