<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/includes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Document</title>
</head>
<body>
     <nav class="navbar">
        <div class="logo">
            Student Management System
        </div>

        <div class="user-info">
            <div class="bell"><i class="fa-solid fa-bell"></i></div>

            <?php if ($user['image']): ?>
                <img src="uploads/<?php echo htmlspecialchars($user['image']); ?>" alt="Profile">
            <?php endif; ?>
            
            <div class="dropdown-toggle" id="dropdownToggle">
                <span>
                    <?php echo htmlspecialchars($user['firstname']); ?>
                    <i class="fa-solid fa-chevron-down"></i>
                </span>
            </div>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#" id="editProfileBtn">
                    <i class="fa-solid fa-user"></i>
                    Profile
                </a>
                <a href="#" id="deleteAccountBtn">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                </a>
                <a href="#" id="logoutBtn">
                    <i class="fa-solid fa-right-from-bracket"></i> 
                    Logout
                </a>
            </div>
        </div>
        <?php include "includes/modals/logout.php"; ?>
        <?php include "includes/modals/profile.php"; ?>
        <?php include "includes/modals/delete.php"; ?>
    </nav>

    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/imagePreview.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>