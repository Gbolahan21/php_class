<?php 
    include "connect/connect.php";
    session_start();

    $success = $_GET['success'];
    $message = $_GET['message'];

    if(!isset($_SESSION["email"])) {
        header("Location: signin.php?message=Please login first");
        exit;
    }

    $email = $_SESSION["email"];
    
    $stmt = mysqli_prepare($db_connect, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/dashboard.css">
        <title>Document</title>
    </head>
    <body>
        <nav class="navbar">

            <div class="logo">
                User Dashboard
            </div>

            <div class="user-info">

                <?php if ($user['image']): ?>

                    <img src="uploads/<?php echo htmlspecialchars($user['image']); ?>" alt="Profile">

                <?php else: ?>

                    <div class="avatar">
                        <?php echo strtoupper($user['firstname'][0]); ?>
                    </div>

                <?php endif; ?>

                <span>
                    Welcome,
                    <?php echo htmlspecialchars($user['firstname']); ?>
                </span>

               <button id="logoutBtn">
                    Logout
                </button>

            </div>

        </nav>

        <div class="container">

            <div class="card">

                <h2>Hello, <?php echo htmlspecialchars($user['firstname']); ?> 👋</h2>

                <p>
                    Welcome back to your dashboard.
                </p>

                <div class="details">

                    <div class="detail">
                        <strong>First Name</strong>
                        <span><?php echo htmlspecialchars($user['firstname']); ?></span>
                    </div>

                    <div class="detail">
                        <strong>Last Name</strong>
                        <span><?php echo htmlspecialchars($user['lastname']); ?></span>
                    </div>

                    <div class="detail">
                        <strong>Email</strong>
                        <span><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>

                </div>

            </div>

             <div class="actions">

                <button class="btn btn-primary" id="editProfileBtn">
                    Update Profile
                </button>

                <button class="btn btn-danger" id="deleteAccountBtn">
                    Delete Account
                </button>

            </div>
        </div>
        
        <div id="profileModal" class="modal">

            <div class="modal-content profile-box">

                <span class="close" id="closeProfile">&times;</span>

                <h2>Update Profile</h2>

                <form action="backend/profile.php" method="POST" enctype="multipart/form-data">

                    <div class="avatar-upload">

                        <label for="fileInput">

                            <?php if (!empty($user['image'])): ?>

                                <img
                                    src="uploads/<?php echo htmlspecialchars($user['image']); ?>"
                                    id="previewImage"
                                    class="profile-preview"
                                    alt="Profile Image"
                                >

                            <?php else: ?>
                                <div id="previewImage" class="profile-avatar">
                                    <?php echo strtoupper($user['firstname'][0]); ?>
                                </div>
                            <?php endif; ?>

                        </label>

                        <input type="file" id="fileInput" name="file" accept="image/*" hidden>

                        <p id="fileName" class="file-name"></p>

                    </div>

                    <label>First Name</label>

                    <input
                        type="text"
                        name="firstname"
                        value="<?php echo htmlspecialchars($user['firstname']); ?>"
                        required>

                    <label>Last Name</label>

                    <input
                        type="text"
                        name="lastname"
                        value="<?php echo htmlspecialchars($user['lastname']); ?>"
                        required>

                    <label>Email</label>

                    <input
                        type="email"
                        value="<?php echo htmlspecialchars($user['email']); ?>"
                        readonly>

                    <label>New Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Leave blank to keep current password">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="cpassword"
                        placeholder="Confirm password">

                    <div class="modal-buttons">

                        <button type="button" id="cancelProfile">
                            Cancel
                        </button>

                        <button type="submit" class="btn-primary">
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div id="deleteModal" class="modal">

            <div class="modal-content delete-box">
                <span class="close" id="closeDelete">&times;</span>

                <h2>Delete Account</h2>

                <form action="backend/delete.php" method="POST">

                    <p>
                        Are you sure you want to delete this account?
                    </p>

                    <div class="user-details">

                        <p><strong>Name:</strong>
                            <?php echo htmlspecialchars($user['firstname']." ".$user['lastname']); ?>
                        </p>

                        <p><strong>Email:</strong>
                            <?php echo htmlspecialchars($user['email']); ?>
                        </p>

                    </div>

                    <div class="modal-buttons">

                        <button type="button" id="cancelDelete">
                            Cancel
                        </button>

                        <button type="submit" class="btn-danger">
                            Delete Account
                        </button>

                    </div>
                </form>

            </div>
        </div>

        <div id="logoutModal" class="modal">

            <div class="modal-content logout-box">

                <span class="close" id="closeLogout">&times;</span>

                <h2>Logout</h2>

                <p>
                    Are you sure you want to logout?
                </p>

                <div class="modal-buttons">

                    <button id="stayLoggedIn">
                        Stay Logged In
                    </button>

                    <button
                        class="btn-danger"
                        onclick="window.location.href='backend/logout.php'">

                        Logout

                    </button>

                </div>

            </div>

        </div>

        <?php if (!empty($success)): ?>
            <script>
                alert("<?php echo htmlspecialchars($success, ENT_QUOTES); ?>");

                // Remove the query string after showing the alert
                if (window.history.replaceState) {
                    const url = window.location.pathname;
                    window.history.replaceState({}, document.title, url);
                }
            </script>
            <?php endif; ?>

            <?php if (!empty($message)): ?>
            <script>
                alert("<?php echo htmlspecialchars($message, ENT_QUOTES); ?>");

                if (window.history.replaceState) {
                    const url = window.location.pathname;
                    window.history.replaceState({}, document.title, url);
                }
            </script>
        <?php endif; ?>

        <script>
            const profileModal = document.getElementById("profileModal");
            const deleteModal = document.getElementById("deleteModal");

            document.getElementById("editProfileBtn").onclick = () => profileModal.style.display = "flex";

            document.getElementById("deleteAccountBtn").onclick = () => deleteModal.style.display = "flex";

            document.getElementById("closeProfile").onclick = () => profileModal.style.display = "none";

            document.getElementById("closeDelete").onclick = () => deleteModal.style.display = "none";

            document.getElementById("cancelDelete").onclick = () => deleteModal.style.display = "none";

            document.getElementById("cancelProfile").onclick = () => profileModal.style.display = "none";

            window.onclick = function(e){

                if(e.target === profileModal){
                    profileModal.style.display="none";
                }

                if(e.target === deleteModal){
                    deleteModal.style.display="none";
                }

                if(e.target === logoutModal){
                    logoutModal.style.display = "none";
                }

            }

            const logoutModal = document.getElementById("logoutModal");

            document.getElementById("logoutBtn").onclick = () => {
                logoutModal.style.display = "flex";
            };

            document.getElementById("closeLogout").onclick = () => {
                logoutModal.style.display = "none";
            };

            document.getElementById("stayLoggedIn").onclick = () => {
                logoutModal.style.display = "none";
            };

            const fileInput = document.getElementById("fileInput");
            const previewImage = document.getElementById("previewImage");
            const fileName = document.getElementById("fileName");

            fileInput.addEventListener("change", function () {

                const file = this.files[0];

                if (!file) return;

                // Show filename
                fileName.textContent = file.name;

                // Preview image
                const reader = new FileReader();

                reader.onload = function (e) {

                    if (previewImage.tagName === "IMG") {
                        previewImage.src = e.target.result;
                    } else {
                        // Replace avatar with image
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.id = "previewImage";
                        img.className = "profile-preview";

                        previewImage.replaceWith(img);
                    }
                };

                reader.readAsDataURL(file);
            });
        </script>

    </body>
</html>