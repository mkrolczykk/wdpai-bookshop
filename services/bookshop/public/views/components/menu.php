<div class="menu-container">
    <div class="menu-row">
        <?php if (!isset($_SESSION['authenticated']) ||
                 ($_SESSION['authenticated'] && $_SESSION['roleId'] === Role::ROLE_USER)): ?>
            <nav class="menu-categories">
                <a class="menu-categories-button">
                    <h2 class="menu-categories-button-title">
                        <i class="fa fa-bars fa-md"></i>
                        <p>Categories</p>
                    </h2>
                    <i class="fa fa-caret-down fa-lg menu-categories-button-icon"></i>
                </a>
                <nav class="menu-categories-content"></nav>
            </nav>
        <?php else: ?>
            <nav class="menu-categories menu-categories-disabled disabled">
                <a class="menu-categories-button disabled">
                    <h2 class="menu-categories-button-title disabled">
                        <i class="fa fa-bars fa-md"></i>
                        <p>Categories</p>
                    </h2>
                    <i class="fa fa-caret-down fa-lg menu-categories-button-icon"></i>
                </a>
            </nav>
        <?php endif; ?>
        <nav class="menu-navigation">
            <div class="menu-navigation-pages">
                <?php if (!isset($_SESSION["authenticated"]) || $_SESSION["roleId"] === Role::ROLE_USER): ?>
                    <a href="/" class="menu-navigation-pages-page">Start page</a>
                    <a href="/newBooks" class="menu-navigation-pages-page">New books</a>
                    <a href="/bestsellers" class="menu-navigation-pages-page">Bestsellers</a>
                    <a href="/contact" class="menu-navigation-pages-page">Contact</a>
                <?php endif; ?>

                <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_USER): ?>
                    <a href="/userDashboard" class="menu-navigation-pages-page">Dashboard</a>
                    <a href="/explore" class="menu-navigation-pages-page">Explore books</a>
                <?php endif; ?>

                <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_EMPLOYEE): ?>
                    <a href="/employeeDashboard" class="menu-navigation-pages-page">Orders</a>
                    <a href="/addBook" class="menu-navigation-pages-page">Add book</a>
                    <a href="/contact" class="menu-navigation-pages-page">Contact</a>
                <?php endif; ?>

                <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_ADMIN): ?>
                    <a href="/adminDashboard" class="menu-navigation-pages-page">Orders</a>
                    <a href="/addBook" class="menu-navigation-pages-page">Add book</a>
                    <a href="/addEmployee" class="menu-navigation-pages-page">Add employee</a>
                <?php endif; ?>
            </div>

            <?php if ($_SESSION["authenticated"] && $_SESSION["roleId"] === Role::ROLE_USER): ?>
                <div class="menu-navigation-other">
                    <a href="/myFavorites" class="menu-navigation-other-favourite-books">
                        <i class="fa fa-heart fa-lg menu-navigation-other-favourite-books-icon"></i>
                        <span class="menu-navigation-other-favourite-books-value">0</span>
                    </a>
                    <a href="/shoppingCart" class="menu-navigation-other-shopping-card">
                        <i class="fa fa-shopping-cart fa-lg menu-navigation-other-shopping-card-icon"></i>
                        <span class="menu-navigation-other-shopping-card-value">0</span>
                    </a>
                </div>
            <?php endif; ?>
        </nav>
        <nav class="menu-mobile">
            <header class="menu-mobile-header">
                <a href="/" class="menu-mobile-header-logo">Book Shop</a>
                <input class="menu-mobile-header-menu-btn" type="checkbox" id="menu-btn" />
                <label class="menu-mobile-header-menu-icon" for="menu-btn"><span class="navicon"></span></label>
                <ul class="menu-mobile-header-menu">
                    <?php if (!isset($_SESSION["authenticated"]) || $_SESSION["roleId"] === Role::ROLE_USER): ?>
                        <?php
                            $menuResult = array(
                                array("Start page", "/"),
                                array("New books", "/newBooks"),
                                array("Bestsellers", "/bestsellers"),
                                array("Contact", "/contact")
                            );
                            foreach($menuResult as $menu) {
                                echo '<li><a href="' . $menu[1] . '">' . $menu[0] . '</a></li>';
                            }
                        ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_USER): ?>
                        <?php
                            $menuResult = array(
                                array("Dashboard", "/userDashboard"),
                                array("Explore books", "/explore")
                            );
                            foreach($menuResult as $menu) {
                                echo '<li><a href="' . $menu[1] . '">' . $menu[0] . '</a></li>';
                            }
                        ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_EMPLOYEE): ?>
                        <?php
                            $menuResult = array(
                                array("Orders", "/employeeDashboard"),
                                array("Add book", "/addBook"),
                                array("Contact", "/contact")
                            );
                            foreach($menuResult as $menu) {
                                echo '<li><a href="' . $menu[1] . '">' . $menu[0] . '</a></li>';
                            }
                        ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION["authenticated"]) && $_SESSION["roleId"] === Role::ROLE_ADMIN): ?>
                        <?php
                            $menuResult = array(
                                array("Orders", "/adminDashboard"),
                                array("Add book", "/addBook"),
                                array("Add employee", "/addEmployee")
                            );
                            foreach($menuResult as $menu) {
                                echo '<li><a href="' . $menu[1] . '">' . $menu[0] . '</a></li>';
                            }
                        ?>
                    <?php endif; ?>
                </ul>
            </header>
        </nav>
    </div>
    <script type="text/javascript" src="public/js/menu.js"></script>
    <script type="text/javascript" src="public/js/favorites/get-favorite-books-count.js"></script>
    <script type="text/javascript" src="public/js/cart/get-shopping-cart-items-count.js"></script>
</div>