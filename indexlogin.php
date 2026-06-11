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

    $upload_error = $_GET['upload_error'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:linear-gradient(135deg,#6a11cb,#2575fc); height:100vh; display:flex; align-items:center; justify-content:center;">

    <div>

        <!-- MESSAGE -->
        <?php if (!empty($message)): ?>
            <div style="
                background:#fff;
                color:#333;
                padding:10px 15px;
                border-radius:8px;
                margin-bottom:15px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);
                font-size:14px;
                text-align:center;
            ">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="login.php" method="POST" enctype="multipart/form-data"
              style="
                background:#fff;
                padding:30px;
                border-radius:12px;
                width:320px;
                box-shadow:0 10px 25px rgba(0,0,0,0.2);
              ">

            <h2 style="text-align:center; margin-bottom:20px; color:#333;">Login</h2>

            <!-- Email -->
            <label style="font-size:14px; color:#555;">Email</label>
            <input type="email" name="email" placeholder="Enter your email"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;">

            <!-- Password -->
            <label style="font-size:14px; color:#555;">Password</label>
            <input type="password" name="password" placeholder="Enter your password"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;">

            <!-- Remember -->
            <div style="display:flex; align-items:center; margin-bottom:20px;">
                <input type="checkbox" name="remember" id="remember" style="margin-right:8px;">
                <label for="remember" style="font-size:14px; color:#555;">Remember Me</label>
            </div>

            <!-- Button -->
            <button type="submit"
                    style="
                        width:100%;
                        padding:12px;
                        border:none;
                        border-radius:8px;
                        background:#2575fc;
                        color:#fff;
                        font-size:16px;
                        cursor:pointer;
                    ">
                Login
            </button>

        </form>

    </div>

</body>
</html>