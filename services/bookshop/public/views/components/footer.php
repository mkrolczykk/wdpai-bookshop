<div class="footer-container">
    <div class="footer-contact">
        <div class="footer-contact-info">
            <h2 class="footer-subtitle">Stay Connected with us</h2>
            <p class="footer-contact-text">Stay connected with us and never miss out on the latest news, updates, and exclusive offers. Follow us on social media and subscribe to our newsletter for more exciting content and special deals.</p>
            <p class="footer-contact-text"><i class="fa fa-envelope fa-lg footer-menu-icon"></i>bookshop@gmail.com</p>
            <p class="footer-contact-text"><i class="fa fa-phone fa-lg footer-menu-icon"></i>+18 26 248 54</p>
            <p class="footer-contact-text"><i class="fa fa-map-marker-alt fa-lg footer-menu-icon"></i>1234 Alaska, Hong Kong, Poland</p>
        </div>
        <div class="footer-menu">
            <div class="footer-menu-nav">
                <h5 class="footer-subtitle">Menu</h5>
                <div class="footer-menu-nav-options">
                    <?php
                        $menuResult = array(
                            array("/", "Start page"),
                            array("/newBooks", "New books"),
                            array("/bestsellers", "Bestsellers"),
                            array("/contact", "Contact"),
                            array("/login", "Log in"),
                            array("/register", "Register")
                        );

                        if (!isset($_SESSION["authenticated"]) || $_SESSION["roleId"] === Role::ROLE_USER) {
                            foreach ($menuResult as $menu) {
                                if ($_SESSION["roleId"] === Role::ROLE_USER && ($menu[0] === "/contact" || $menu[0] === "/login" || $menu[0] === "/register")) {
                                    continue;
                                }
                                echo '<a href="' . $menu[0] . '" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>' . $menu[1] . '</a>';
                            }
                        }

                        if (isset($_SESSION["authenticated"])) {
                            if ($_SESSION["roleId"] === Role::ROLE_USER) {
                                echo '
                                    <a href="/userDashboard" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Dashboard</a>
                                    <a href="/explore" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Explore books</a>
                                    <a href="/contact" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Contact</a>
                                ';
                            } elseif ($_SESSION["roleId"] === Role::ROLE_EMPLOYEE) {
                                echo '
                                    <a href="/orders" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Orders</a>
                                    <a href="/addBook" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Add book</a>
                                    <a href="/contact" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Contact</a>
                                ';
                            } elseif ($_SESSION["roleId"] === Role::ROLE_ADMIN) {
                                echo '
                                    <a href="/orders" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Orders</a>
                                    <a href="/addBook" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Add book</a>
                                    <a href="/employees" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Employees</a>
                                    <a href="/addEmployee" class="footer-menu-nav-option"><i class="fa fa-caret-right fa-lg footer-menu-icon"></i>Add employee</a>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-media">
            <?php if (!isset($_SESSION["authenticated"])): ?>
                <h5 class="footer-subtitle">Not registered yet?</h5>
                <p class="footer-media-text">Create your account ASAP!</p>
                <div class="footer-media-button button">
                    <a href="/register">Register</a>
                </div>
            <?php elseif ($_SESSION["authenticated"] &&
                          $_SESSION["roleId"] === Role::ROLE_USER): ?>
                <h5 class="footer-subtitle">Thank you for being with us!</h5>
                <p class="footer-media-text">We really appreciate your effort</p>
                <div class="footer-media-button button">
                    <a href="/explore">Browse our products</a>
                </div>
            <?php elseif ($_SESSION["authenticated"] &&
                          $_SESSION["roleId"] === Role::ROLE_EMPLOYEE): ?>
                <h5 class="footer-subtitle">Employee panel</h5>
                <p class="footer-media-text">We really appreciate your effort</p>
                <div class="footer-media-button button">
                    <a href="/orders">Fulfill orders</a>
                </div>
            <?php elseif ($_SESSION["authenticated"] &&
                          $_SESSION["roleId"] === Role::ROLE_ADMIN): ?>
                <h5 class="footer-subtitle">Administrator panel</h5>
                <p class="footer-media-text">Book shop admin panel</p>
                <div class="footer-media-button button">
                    <a href="/employees">Employees</a>
                </div>
            <?php endif; ?>
            <h6 class="footer-subtitle">Find us on social media</h6>
            <div class="footer-media-links">
                <a class="footer-media-link" href="/"><i class="fa-brands fa-twitter fa-lg footer-media-link-icon"></i></a>
                <a class="footer-media-link" href="/"><i class="fa-brands fa-facebook fa-lg footer-media-link-icon"></i></a>
                <a class="footer-media-link" href="/"><i class="fa-brands fa-linkedin fa-lg footer-media-link-icon"></i></a>
                <a class="footer-media-link" href="/"><i class="fa-brands fa-instagram fa-lg footer-media-link-icon"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-domain" style=" !important;">
        <div class="footer-domain-domain">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="footer-domain-domain" href="/">Book shop</a>. All Rights Reserved. Designed
                by
                <a class="footer-domain-designer" >Marcin Krolczyk</a>
            </p>
        </div>
        <div class="footer-domain-payments">
            <img class="footer-domain-payments-image" src="public/img/payments.png" alt="Available payments">
        </div>
    </div>
</div>