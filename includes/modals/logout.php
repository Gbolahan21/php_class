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
                onclick="window.location.href='backend/logout.php'"
            >
                Logout
            </button>
        </div>
    </div>
</div>