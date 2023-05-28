const welcomeSection = document.getElementById('welcome-section');
const closeButton = document.getElementById('close-button');

function closeWelcomeSection() {
    welcomeSection.style.display = 'none';

    // Set welcome_shown cookie
    document.cookie = 'welcome_shown=true; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/';
}

// Add event listener
closeButton.addEventListener('click', closeWelcomeSection);

// Show welcome section
welcomeSection.style.display = 'block';