/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function openButton(id) {
    document.getElementById(id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
        var dropdownIds = ['account', 'currency', 'language'];
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var dropdown = dropdowns[i];
            var dropdownId = dropdown.getAttribute('id');
            if (dropdown.classList.contains('show') && !e.target.closest('#' + dropdownId)) {
                dropdown.classList.remove('show');
            }
        }
    }
}