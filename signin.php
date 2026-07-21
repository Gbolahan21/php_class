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
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div>
        <!-- MESSAGE -->
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="backend/login.php" method="POST" enctype="multipart/form-data" class="login-form">

            <h2>Login</h2>

            <!-- Email -->
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email">

            <!-- Password -->
            <label>Password</label>
            <div class="password-field">
                <input type="password" id="password" name="password" placeholder="Enter your password">

                <i class="fa-solid fa-eye" id="togglePassword"></i>
            </div>

            <!-- Remember -->
            <div class="rememberMe">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <!-- Button -->
            <button type="submit">
                Login
            </button>

            <p class="register-link">
                Don't have an account?
                <a href="signup.php">Register</a>
            </p>

        </form>

    </div>

     <script>
        const password = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {

            if (password.type === "password") {
                password.type = "text";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            }

        });
    </script>

</body>
</html>