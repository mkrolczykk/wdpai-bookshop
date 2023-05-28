function toggleOrderDropdown(button) {
    button.classList.toggle("active");

    const dropdownContent = button.nextElementSibling;

    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "";
    } else {
        dropdownContent.style.display = "block";
    }
}