<div class="navbar">
    <div class="navbar-logo">
        <?php
            $redirectUrl = '/';

            if (isset($_SESSION['authenticated'])) {

                switch ($_SESSION['roleId']) {
                    case Role::ROLE_USER:
                        $redirectUrl = '/userDashboard';
                        break;
                    case Role::ROLE_EMPLOYEE:
                        $redirectUrl = '/employeeDashboard';
                        break;
                    case Role::ROLE_ADMIN:
                        $redirectUrl = '/adminDashboard';
                        break;
                }
            }
        ?>
        <a href="<?php echo $redirectUrl ?>">
            <?php
            $roleText = '';

            if (!isset($_SESSION["authenticated"])) {
                $roleText = "Book Shop";
            } elseif ($_SESSION["authenticated"] && $_SESSION["roleId"] === Role::ROLE_USER) {
                $roleText = "Book Shop";
            } elseif ($_SESSION["authenticated"] && $_SESSION["roleId"] === Role::ROLE_EMPLOYEE) {
                $roleText = "Employee Panel";
            } elseif ($_SESSION["authenticated"] && $_SESSION["roleId"] === Role::ROLE_ADMIN) {
                $roleText = "Admin Panel";
            }
            ?>

            <span><?php echo $roleText; ?></span>
        </a>
    </div>
    <?php if (!isset($_SESSION["authenticated"]) || $_SESSION["roleId"] === Role::ROLE_USER): ?>
        <div class="navbar-search">
            <form class="navbar-search-form" action="search" method="POST">
                <div class="navbar-search-box">
                    <input name="searchkey" type="text" placeholder="Search for title, author">
                    <input type="hidden" name="currency" value="USD">
                    <button type="submit"><i class="fa fa-search navbar-search-icon"></i></button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="navbar-search navbar-search-disabled blocked">
            <form class="navbar-search-form" action="search" method="POST">
                <div class="navbar-search-box">
                    <input name="searchkey" type="text" placeholder="Search for title, author" disabled>
                    <input type="hidden" name="currency" value="USD">
                    <button type="submit" disabled><i class="fa fa-search navbar-search-icon"></i></button>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <div class="customer-service">
        <div class="phone-number">
            <p>Customer Support</p>
            <h5>+18 26 248 54</h5>
        </div>
    </div>
</div>