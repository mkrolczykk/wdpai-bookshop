function toggleOrderDropdown(button) {
    button.classList.toggle("active");

    let dropdownContent = button.nextElementSibling;

    console.log(dropdownContent)
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
}