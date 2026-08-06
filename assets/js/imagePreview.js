function setupImagePreview(inputId, previewId, fileNameId) {

    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const fileName = document.getElementById(fileNameId);

    if (!input || !preview || !fileName) return;

    input.addEventListener("change", function () {

        const file = this.files[0];

        if (!file) return;

        fileName.textContent = file.name;

        const reader = new FileReader();

        reader.onload = function (e) {

            if (preview.tagName === "IMG") {

                preview.src = e.target.result;

            } else {

                const img = document.createElement("img");

                img.src = e.target.result;
                img.id = previewId;
                img.className = "profile-preview";

                preview.replaceWith(img);

            }

        };

        reader.readAsDataURL(file);

    });

}