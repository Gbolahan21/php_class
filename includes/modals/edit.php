<div id="editStudentModal" class="modal">

    <div class="modal-content student-modal">

        <span class="close" id="closeEditStudent">&times;</span>

        <h2>Edit Student</h2>

        <form action="backend/student/edit.php" method="POST">

            <input type="hidden" name="id" id="editStudentId">

            <div class="form-grid">

                <div class="form-group">
                    <label>Matric No</label>
                    <input
                        type="text"
                        name="matric_no"
                        id="editMatricNo"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="firstname"
                        id="editFirstname"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="lastname"
                        id="editLastname"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        id="editEmail"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Gender</label>

                    <div class="select-wrapper">
                        <select name="gender" id="editGender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department</label>

                    <div class="select-wrapper">
                        <select name="department" id="editDepartment" required>
                            <option value="">Select Department</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Cybersecurity">Cybersecurity</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Biology">Biology</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Level</label>

                    <div class="select-wrapper">
                        <select name="level" id="editLevel" required>
                            <option value="">Select Level</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                            <option value="600">600</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <div class="select-wrapper">
                        <select name="status" id="editStatus" required>
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

            </div>

            <div class="modal-buttons">

                <button type="button" id="cancelEditStudent">
                    Cancel
                </button>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>