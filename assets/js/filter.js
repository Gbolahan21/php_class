document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("studentSearch");

    const filterDropdowns = document.querySelectorAll(".filter-dropdown");

    const studentRows = document.querySelectorAll(
        ".students-table tbody tr"
    );

    let filters = {
        department: "all",
        level: "all",
        status: "all"
    };


    /*
    ========================================
    DROPDOWN TOGGLE
    ========================================
    */

    filterDropdowns.forEach(dropdown => {

        const toggle = dropdown.querySelector(".filter-toggle");
        const menu = dropdown.querySelector(".filter-menu");

        toggle.addEventListener("click", function (e) {

            e.stopPropagation();

            // Close other dropdowns
            filterDropdowns.forEach(otherDropdown => {

                if (otherDropdown !== dropdown) {

                    otherDropdown
                        .querySelector(".filter-menu")
                        .classList.remove("show");

                }

            });

            menu.classList.toggle("show");

        });

    });


    /*
    ========================================
    FILTER SELECTION
    ========================================
    */

    document.querySelectorAll(".filter-menu a").forEach(option => {

        option.addEventListener("click", function (e) {

            e.preventDefault();

            const filterType = this.dataset.filter;
            const value = this.dataset.value;

            filters[filterType] = value;


            // Change button text
            const dropdown = this.closest(".filter-dropdown");

            const buttonText = dropdown.querySelector(
                ".filter-toggle span"
            );

            buttonText.textContent = value === "all"
                ? getDefaultText(filterType)
                : value;


            // Close dropdown
            dropdown
                .querySelector(".filter-menu")
                .classList.remove("show");


            applyFilters();

        });

    });


    /*
    ========================================
    SEARCH
    ========================================
    */

    if (searchInput) {

        searchInput.addEventListener("input", function () {

            applyFilters();

        });

    }


    /*
    ========================================
    APPLY FILTERS
    ========================================
    */

    function applyFilters() {

        const searchValue = searchInput
            ? searchInput.value.toLowerCase().trim()
            : "";


        studentRows.forEach(row => {

            const rowText = row.textContent.toLowerCase();

            const department = (
                row.dataset.department || ""
            ).toLowerCase();

            const level = (
                row.dataset.level || ""
            ).toLowerCase();

            const status = (
                row.dataset.status || ""
            ).toLowerCase();


            // Search
            const matchesSearch =
                searchValue === "" ||
                rowText.includes(searchValue);


            // Department
            const matchesDepartment =
                filters.department === "all" ||
                department === filters.department.toLowerCase();


            // Level
            const matchesLevel =
                filters.level === "all" ||
                level === filters.level.toLowerCase();


            // Status
            const matchesStatus =
                filters.status === "all" ||
                status === filters.status.toLowerCase();


            // Show / hide
            if (
                matchesSearch &&
                matchesDepartment &&
                matchesLevel &&
                matchesStatus
            ) {

                row.style.display = "";

            } else {

                row.style.display = "none";

            }

        });

    }


    /*
    ========================================
    DEFAULT BUTTON TEXT
    ========================================
    */

    function getDefaultText(filterType) {

        if (filterType === "department") {
            return "Department";
        }

        if (filterType === "level") {
            return "Level";
        }

        if (filterType === "status") {
            return "Status";
        }

    }


    /*
    ========================================
    CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
    ========================================
    */

    document.addEventListener("click", function () {

        filterDropdowns.forEach(dropdown => {

            dropdown
                .querySelector(".filter-menu")
                .classList.remove("show");

        });

    });

});