const openButton = (id) => {
    document.getElementById(id).classList.toggle("show");
};

const closeDropdowns = (event) => {
    if (!event.target.matches('.dropbtn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        Array.from(dropdowns).forEach((dropdown) => {
            const dropdownId = dropdown.getAttribute("id");
            if (dropdown.classList.contains("show") && !event.target.closest(`#${dropdownId}`)) {
                dropdown.classList.remove("show");
            }
        });
    }
};

window.addEventListener("click", closeDropdowns);