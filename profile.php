<?php 
     include "connect.php";
    session_start();

    if(!isset($_SESSION["email"])) {
        header("Location: index.php?message=Please login first");
        exit;
    }

    $email = $_SESSION["email"];
    
    $query = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `email` = '$email'");
    $user = mysqli_fetch_assoc($query);

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
        <form action="edit.php" method="POST" enctype="multipart/form-data"
              style="
                background:#fff;
                padding:30px;
                border-radius:12px;
                width:320px;
                box-shadow:0 10px 25px rgba(0,0,0,0.2);
              ">

            <h2 style="text-align:center; margin-bottom:20px; color:#333;">Profile</h2>

            <!-- Upload Avatar -->
            <div style="text-align:center; margin-bottom:20px;">
                <label style="cursor:pointer;">

                    <!-- TEXT CONTAINER -->
                    <div id="uploadBox"
                        style="
                            width:90px;
                            height:90px;
                            border-radius:50%;
                            background:#eee;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            margin:auto;
                            font-size:12px;
                            color:#777;
                            text-align:center;
                            padding:5px;
                            overflow:hidden;
                        ">
                        Upload
                    </div>

                    <!-- FILE INPUT -->
                    <input type="file" name="file" id="fileInput" style="display:none;">
                </label>
                <!-- ERROR MESSAGE -->
                <?php if ($upload_error): ?>
                    <p style="
                        color:red;
                        font-size:12px;
                        margin-top:8px;
                    ">
                        <?php echo htmlspecialchars($upload_error); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- name -->
            <label style="font-size:14px; color:#555;">Name</label>
            <input type="text" name="name" placeholder="Enter your first name"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;">


            <!-- Email -->
            <label style="font-size:14px; color:#555;">Email</label>
            <input type="email" name="email" placeholder="Enter your email"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;" value="<?php echo htmlspecialchars($user['email']); ?>" disabled="true">

            <!-- Password -->
            <label style="font-size:14px; color:#555;">Password</label>
            <input type="password" name="password" placeholder="Enter your password"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;">

             <!-- Confirm Password -->
            <label style="font-size:14px; color:#555;">Confirm Password</label>
            <input type="password" name="cpassword" placeholder="Enter password again"
                   style="width:100%; padding:10px; margin:5px 0 15px; border-radius:8px; border:1px solid #ccc; outline:none;">

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
                Update 
            </button>

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
    </script>
</body>
</html>