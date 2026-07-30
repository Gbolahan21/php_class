function initUserDropdown() {

    const toggle = document.getElementById("dropdownToggle");
    const menu = document.getElementById("dropdownMenu");

    if (!toggle || !menu) return;

    // Toggle dropdown
    toggle.addEventListener("click", function (e) {

        e.stopPropagation();
        menu.classList.toggle("show");

    });

    // Prevent closing when clicking inside the menu
    menu.addEventListener("click", function (e) {

        e.stopPropagation();

    });

    // Close when clicking anywhere else
    document.addEventListener("click", function () {

        menu.classList.remove("show");

    });

}

function initActionDropdowns() {

    document.querySelectorAll(".action-toggle").forEach(button => {

        button.addEventListener("click", function (e) {

            e.stopPropagation();

            document.querySelectorAll(".action-menu").forEach(menu => {

                if (menu !== this.nextElementSibling) {
                    menu.classList.remove("show");
                }

            });

            this.nextElementSibling.classList.toggle("show");

        });

    });

    // Close all action menus when clicking elsewhere
    document.addEventListener("click", function () {

        document.querySelectorAll(".action-menu").forEach(menu => {

            menu.classList.remove("show");

        });

    });

}