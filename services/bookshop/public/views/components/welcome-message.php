<?php
    if (!isset($_COOKIE["welcome_shown"]) || $_COOKIE["welcome_shown"] !== "true") {
        echo '
            <section id="welcome-section" class="welcome-section">
                <div class="welcome-message">
                    <h1 class="welcome-message-text">Welcome ' . $_SESSION["name"] . '! Login was successful.</h1>
                    <button id="close-button" class="welcome-message-button">&times;</button>
                </div>
                <script type="text/javascript" src="public/js/dashboard-popup.js"></script>
            </section>
        ';
    }
?>