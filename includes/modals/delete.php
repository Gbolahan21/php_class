<div id="studentDeleteModal" class="modal">

    <div class="modal-content delete-box">

        <span class="close" id="closeStudentDelete">&times;</span>

        <h2>Delete Student</h2>

        <p>
            Are you sure you want to delete this student?
        </p>

        <div class="user-details">

            <p>
                <strong>Name:</strong>
                <span id="deleteStudentName"></span>
            </p>

            <p>
                <strong>Email:</strong>
                <span id="deleteStudentEmail"></span>
            </p>

        </div>

        <div class="modal-buttons">

            <button type="button" id="cancelStudentDelete">
                Cancel
            </button>

            <button type="button" class="btn-danger">
                <a
                    href="#"
                    id="confirmStudentDelete"
                    style="color: white; text-decoration: none;"
                >
                    Delete Student
                </a>
            </button>

        </div>

    </div>

</div>