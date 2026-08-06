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

document.getElementById("editProfileBtn").addEventListener("click", function(e){

    e.preventDefault();

    openModal("profileModal");

});

document.getElementById("closeProfile").addEventListener("click", () => {
    closeModal("profileModal");
});

document.getElementById("cancelProfile").addEventListener("click", () => {
    closeModal("profileModal");
});

document.getElementById("logoutBtn").addEventListener("click", function(e){

    e.preventDefault();

    openModal("logoutModal");

});

document.getElementById("stayLoggedIn").addEventListener("click", () => {
    closeModal("logoutModal");
});

document.getElementById("deleteAccountBtn").addEventListener("click", function(e){

    e.preventDefault();

    openModal("deleteModal");

});

document.getElementById("closeDelete").addEventListener("click", () => {
    closeModal("deleteModal");
});

document.getElementById("cancelDelete").addEventListener("click", () => {
    closeModal("deleteModal");
});

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