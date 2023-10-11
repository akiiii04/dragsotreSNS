function toggleContent() {
    let content = document.getElementById("hidden");
    if (content.style.display === "none") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filter-form');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            form.submit();
        });
    });
});
