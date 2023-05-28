const scrollTop = () => {
    const scrollBtn = document.createElement("button");
    scrollBtn.innerHTML = "&uarr;";
    scrollBtn.setAttribute("id", "scroll-btn");
    document.body.appendChild(scrollBtn);

    const scrollBtnDisplay = () => {
        scrollBtn.classList.toggle("show", window.scrollY > window.innerHeight);
    };
    window.addEventListener("scroll", scrollBtnDisplay);

    const scrollWindow = () => {
        if (window.scrollY !== 0) {
            setTimeout(() => {
                window.scrollTo(0, window.scrollY - 50);
                scrollWindow();
            }, 5);
        }
    };

    scrollBtn.addEventListener("click", scrollWindow);
};
// Start automatically
scrollTop();