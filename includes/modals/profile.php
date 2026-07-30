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
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

            <label>Last Name</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>"required>

            <label>Email</label>
            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>

            <label>New Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep current password">

            <label>Confirm Password</label>
            <input type="password" name="cpassword"placeholder="Confirm password">

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