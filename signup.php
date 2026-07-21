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
    <link rel="stylesheet" href="assets/css/register.css">
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
        <form action="backend/register.php" method="POST" enctype="multipart/form-data" class="register-form">
            <h2>Register</h2>

            <!-- Upload Avatar -->
            <div class="avatar-upload">
                <label>
                    <!-- TEXT CONTAINER -->
                    <div id="uploadBox" class="upload-box">Upload</div>

                    <!-- FILE INPUT -->
                    <input type="file" name="file" id="fileInput" class="input">
                </label>
                <!-- ERROR MESSAGE -->
                <?php if ($upload_error): ?>
                    <p class="error">
                        <?php echo htmlspecialchars($upload_error); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- firstname -->
            <label>First Name</label>
            <input type="text" name="firstname" placeholder="Enter your first name" require>

            <!-- lastname -->
            <label>Last Name</label>
            <input type="text" name="lastname" placeholder="Enter your last name" require>

            <!-- Email -->
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" require>

            <!-- Password -->
            <label>Password</label>
           <div class="password-field">
                <input type="password" id="password" name="password" placeholder="Enter your password" require>

                <i class="fa-solid fa-eye" id="togglePassword"></i>
            </div>

             <!-- Confirm Password -->
            <label>Confirm Password</label>
            <div class="password-field">
                <input type="password" id="confirmPassword" name="cpassword" placeholder="Confirm password" require>

                <i class="fa-solid fa-eye" id="toggleConfirmPassword"></i>
            </div>

            <!-- Button -->
            <button type="submit">
                Register
            </button>

            <p class="login-link">
                Already have an account?
                <a href="signin.php">Login</a>
            </p>

        </form>

    </div>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const box = document.getElementById('uploadBox');

            if (file) {
                box.textContent = file.name; // ✅ show file name
            } else {
                box.textContent = "Upload"; // fallback
            }
        });

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

        const confirmPassword = document.getElementById("confirmPassword");
        const toggleConfirm = document.getElementById("toggleConfirmPassword");

        toggleConfirm.addEventListener("click", function () {

            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                confirmPassword.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }

        });

        const form = document.querySelector(".register-form");

        form.addEventListener("submit", function (e) {

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            // At least 8 characters
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                e.preventDefault();
                return;
            }

            // Uppercase
            if (!/[A-Z]/.test(password)) {
                alert("Password must contain at least one uppercase letter.");
                e.preventDefault();
                return;
            }

            // Lowercase
            if (!/[a-z]/.test(password)) {
                alert("Password must contain at least one lowercase letter.");
                e.preventDefault();
                return;
            }

            // Number
            if (!/[0-9]/.test(password)) {
                alert("Password must contain at least one number.");
                e.preventDefault();
                return;
            }

            // Special character
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                alert("Password must contain at least one special character.");
                e.preventDefault();
                return;
            }

            // Match confirmation
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                e.preventDefault();
                return;
            }

        });
    </script>
</body>
</html>