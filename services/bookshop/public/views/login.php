<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <script type="text/javascript" src="public/js/topbar.js"></script>
    <script type="text/javascript" src="public/js/menu.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <section class="login-content">
        <h2 class="page-section-title login-content-title">Login to the site</h2>
        <div class="login-section-form-container">
            <form id="login" class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <fieldset>
                    <input name="email" placeholder="Email Address" type="email" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input name="password" placeholder="Password" type="password" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Login</button>
                </fieldset>
                <p class="login-terms">
                    By logging in to the site, you agree to
                    the <a href="/contact">Privacy Policy</a> and <a href="/contact">Terms of Use</a> of the store.
                </p>
                <p class="login-redirect">No account yet?<a href="/register">Register</a></p
            </form>
        </div>
    </section>
    <?php
        include "components/footer.php";
    ?>
</body>