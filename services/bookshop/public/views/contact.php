<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/contact.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/books-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/encouragement-bar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <section class="contact-content">
        <h2 class="page-section-title contact-content-title">Contact Us</h2>
        <div class="contact-content-section">
            <div class="contact-content-section-form-container">
                <form id="contact" action="" method="POST">
                    <h3>Contact Form</h3>
                    <h4>Contact us for custom quote</h4>
                    <fieldset>
                        <input placeholder="Name" type="text" tabindex="1" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Email Address" type="email" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Phone Number (optional)" type="tel" tabindex="3" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Web Site (optional)" type="url" tabindex="4" required>
                    </fieldset>
                    <fieldset>
                        <textarea placeholder="Type your message here...." tabindex="5" required></textarea>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Message sent! Our support will answer you soon.')">Submit</button>
                    </fieldset>
                </form>
            </div>
            <div class="contact-content-section-right-side">
                <div class="contact-content-section-right-side-map">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2541.8775572272696!2d19.93932431605335!3d50.061299926847496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47165dd514c3a7db%3A0x473bfb9e0e4b16f4!2sKrak%C3%B3w%20Rynek%20G%C5%82%C3%B3wny!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd?q"
                            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
                <div class="contact-content-section-right-side-contact">
                    <p><i class="fa fa-map-marker-alt fa-lg"></i>1234 Alaska, Hong Kong, Poland</p>
                    <p><i class="fa fa-envelope fa-lg"></i>bookshop@gmail.com</p>
                    <p><i class="fa fa-phone fa-lg"></i>+18 26 248 54</p>
                </div>
            </div>
        </div>
    </section>
    <?php
        if (!isset($_SESSION["authenticated"])) {
            include "components/encouragement-bar.php";
        }
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>