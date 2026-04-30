<?php 
    session_start();

    if (isset($_SESSION['email'])) {
        header("Location: dashboard.php");
        exit;
    }

    if (isset($_COOKIE['email'])) {
        $_SESSION['email'] = $_COOKIE['email'];
        header("Location: dashboard.php");
        exit;
    }

    $message = !empty($_GET['message']) ? $_GET["message"] : "Enter your credentials";
    echo htmlspecialchars($message)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="email" id="email">Email</label>
        <input type="email" name="email" placeholder="Enter your email">
        <label for="password" id="password">Password</label>
        <input type="password" name="password" placeholder="Enter your password">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
        <button type="submit">Login</button>
    </form>
</body>
</html>