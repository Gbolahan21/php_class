<?php

include "../../connect/connect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../../dashboard.php?message=Invalid student ID");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $db_connect,
    "DELETE FROM students WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    header("Location: ../../dashboard.php?success=Student deleted successfully");
    exit;

}

header("Location: ../../dashboard.php?message=Unable to delete student");
exit;
?>