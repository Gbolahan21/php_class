<?php 
    session_start();

    if(!isset($_SESSION["email"])) {
        header("Location: index.php?message=pls login first");
        exit;
    }

    $email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($email); ?></h2>
</body>
</html>