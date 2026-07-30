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