function openModal(id) {
    document.getElementById(id).style.display = "flex";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

window.addEventListener("click", function (e) {

    document.querySelectorAll(".modal").forEach(modal => {

        if (e.target === modal) {
            modal.style.display = "none";
        }

    });

});

document.getElementById("logoutBtn").addEventListener("click", function(e){

    e.preventDefault();

    openModal("logoutModal");

});

document.getElementById("stayLoggedIn").addEventListener("click", () => {
    closeModal("logoutModal");
});

function initStudentDeleteModal() {

    const deleteButtons = document.querySelectorAll(".delete-action");

    const modal = document.getElementById("studentDeleteModal");
    const closeBtn = document.getElementById("closeStudentDelete");
    const cancelBtn = document.getElementById("cancelStudentDelete");

    const studentName = document.getElementById("deleteStudentName");
    const studentEmail = document.getElementById("deleteStudentEmail");

    const confirmBtn = document.getElementById("confirmStudentDelete");

    if (!modal) return;

    deleteButtons.forEach(button => {

        button.addEventListener("click", function(e) {

            e.preventDefault();

            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;

            studentName.textContent = name;
            studentEmail.textContent = email;

            confirmBtn.href = `backend/student/delete.php?id=${id}`;

            openModal("studentDeleteModal");

        });

    });

    closeBtn.addEventListener("click", function() {
        closeModal("studentDeleteModal");
    });

    cancelBtn.addEventListener("click", function() {
        closeModal("studentDeleteModal");
    });

}

function initStudentEditModal() {

    const editButtons = document.querySelectorAll(".edit-student");

    const modal = document.getElementById("editStudentModal");
    const closeBtn = document.getElementById("closeEditStudent");
    const cancelBtn = document.getElementById("cancelEditStudent");

    if (!modal) return;

    editButtons.forEach(button => {

        button.addEventListener("click", function(e) {

            e.preventDefault();

            document.getElementById("editStudentId").value =
                this.dataset.id;

            document.getElementById("editMatricNo").value =
                this.dataset.matric;

            document.getElementById("editFirstname").value =
                this.dataset.firstname;

            document.getElementById("editLastname").value =
                this.dataset.lastname;

            document.getElementById("editEmail").value =
                this.dataset.email;

            document.getElementById("editGender").value =
                this.dataset.gender;

            document.getElementById("editDepartment").value =
                this.dataset.department;

            document.getElementById("editLevel").value =
                this.dataset.level;

            document.getElementById("editStatus").value =
                this.dataset.status;

            openModal("editStudentModal");

        });

    });

    closeBtn.addEventListener("click", function() {
        closeModal("editStudentModal");
    });

    cancelBtn.addEventListener("click", function() {
        closeModal("editStudentModal");
    });
}

document.getElementById("addStudentBtn").addEventListener("click", function(e){

    e.preventDefault();

    openModal("addStudentModal");

});

document.getElementById("closeStudent").addEventListener("click", () => {
    closeModal("addStudentModal");
});

document.getElementById("cancelStudent").addEventListener("click", () => {
    closeModal("addStudentModal");
});