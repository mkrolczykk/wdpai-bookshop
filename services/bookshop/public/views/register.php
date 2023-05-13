<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
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
    <section class="register-content">
        <h2 class="page-section-title register-content-title">Create an Account</h2>
        <div class="register-section-form-container">
            <form id="register" class="register" action="register" method="POST">
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
                    <input name="name" placeholder="Name" type="text" tabindex="0" required>
                </fieldset>
                <fieldset>
                    <input name="surname" placeholder="Surname" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input name="username" placeholder="Username" type="text" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input name="email" placeholder="Email Address" type="email" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <input name="password" placeholder="Password" type="password" tabindex="4" required>
                </fieldset>
                <fieldset>
                    <input name="confirmedPassword" placeholder="Confirm Password" type="password" tabindex="5" required>
                </fieldset>
                <fieldset>
                    <input name="notifications" type="hidden" id="notifications" value="0">
                </fieldset>
                <fieldset class="notifications-fieldset">
                    <input name="notifications" type="checkbox" id="notifications" value="1" checked>
                    <label for="notifications">
                        I want to receive notifications about new products to the e-mail address I provided.
                    </label>
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Register</button>
                </fieldset>
                <p class="register-terms">
                    By creating an account, you agree to
                    the <a href="/contact">Privacy Policy</a> and <a href="/contact">Terms of Use</a> of the store.
                </p>
                <p class="register-redirect">Already have an account?<a href="/login">Login</a></p
            </form>
        </div>
    </section>
    <?php
        include "components/footer.php";
    ?>
</body>