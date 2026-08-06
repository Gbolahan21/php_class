<div id="addStudentModal" class="modal">

    <div class="modal-content student-modal">

       <span class="close" id="closeStudent">&times;</span>

        <h2>Add New Student</h2>

        <form action="backend/student/create.php" method="POST" enctype="multipart/form-data">

            <!-- Student Photo -->
            <div class="avatar-upload">

                <label for="studentFileInput">

                    <div id="studentPreview" class="profile-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                </label>

                <input
                    type="file"
                    id="studentFileInput"
                    name="image"
                    accept="image/*"
                    hidden
                >

                <p id="studentFileName" class="file-name">
                    Click to upload student photo
                </p>

            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Matric No</label>
                    <input
                        type="text"
                        name="matric_no"
                        placeholder="e.g. 2022006372"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="firstname"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="lastname"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input
                        type="text"
                        name="phone"
                    >
                </div>

                <div class="form-group">

                    <label>Gender</label>

                    <div class="select-wrapper">

                        <select name="gender" required>
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>

                        <i class="fa-solid fa-chevron-down"></i>

                    </div>

                </div>

                <div class="form-group">
                    <label>Department</label>

                    <div class="select-wrapper">
                        <select name="department" required>
                            <option value="">Select Department</option>
                            <option>Computer Science</option>
                            <option>Cybersecurity</option>
                            <option>Accounting</option>
                            <option>Biology</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                </div>

                <div class="form-group">
                    <label>Level</label>

                    <div class="select-wrapper">
                        <select name="level" required>
                            <option value="">Select Level</option>
                            <option>100</option>
                            <option>200</option>
                            <option>300</option>
                            <option>400</option>
                            <option>500</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <div class="select-wrapper">
                        <select name="status" required>
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

            </div>

            <div class="modal-buttons">

                <button
                    type="button"
                    id="cancelStudent"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Student
                </button>

            </div>

        </form>

    </div>

</div>