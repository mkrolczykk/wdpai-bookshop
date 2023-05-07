<!DOCTYPE html>
<html lang="en">

<head>
    <title>Start page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/start-page.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/books-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/encouragement-bar.css">
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
    <div class="start-page-content">
        <section class="start-page-content-start">
            <div class="start-page-content-start-left">
                <div class="start-page-content-left-image">
                    <img src="./public/img/start-page-image1.png" alt="">
                </div>
                <div class="start-page-content-left-descr">
                    <h1>The world of books</h1>
                    <p>
                        Discover the vast world of books and embark on a literary adventure with our diverse collection.
                    </p>
                    <?php
                        if (isset($_SESSION["authenticated"])) {
                            switch ($_SESSION["roleId"]) {
                                case Role::ROLE_USER:
                                    $href = "/shopping";
                                    break;
                                case Role::ROLE_EMPLOYEE:
                                case Role::ROLE_ADMIN:
                                    $href = "/";
                                    break;
                            }
                        } else {
                            $href = "/login";
                        }
                    ?>
                    <div class="start-page-content-start-right-button button">
                        <a href="<?= $href ?>">Buy now</a>
                    </div>
                </div>
            </div>
            <div class="start-page-content-start-right">
                <div class="start-page-content-start-right-title">
                    <h1>We already have over <h2 class="unique-value-style">2464</h2></h1><h1>books in our warehouses!</h1>
                </div>
                <div class="start-page-content-start-right-image">
                    <img src="./public/img/start-page-image2.png" alt="">
                </div>
            </div>
        </section>
        <section class="start-page-content-features">
            <div class="start-page-content-features-feature">
                <div class="start-page-content-features-feature-image">
                    <i class='fa-solid fa-check-double'></i>
                </div>
                <div class="start-page-content-features-feature-title">
                    <h2>High-quality Books</h2>
                </div>
            </div>
            <div class="start-page-content-features-feature">
                <div class="start-page-content-features-feature-image">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="start-page-content-features-feature-title">
                    <h2>Free Delivery</h2>
                </div>
            </div>
            <div class="start-page-content-features-feature">
                <div class="start-page-content-features-feature-image">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="start-page-content-features-feature-title">
                    <h2>21-Day Return</h2>
                </div>
            </div>
            <div class="start-page-content-features-feature">
                <div class="start-page-content-features-feature-image">
                    <i class="fas fa-phone-volume"></i>
                </div>
                <div class="start-page-content-features-feature-title">
                    <h2>24/7 Support</h2>
                </div>
            </div>
        </section>
        <section class="start-page-content-categories">
            <section class="start-page-content-books-categories">
                <h1 class="start-page-content-books-categories-title">Categories</h1>
                <div class="start-page-content-books-categories-container">
                    <div class="start-page-content-books-categories-container-category">
                        <img src="" alt="">
                        <h2></h2>
                    </div>
                </div>
            </section>
        </section>
        <section class="start-page-content-top-books">
            <h1 class="start-page-content-top-books-title">Best selling books</h1>
            <?php if (!empty($booksResult)): ?>
                <?php include "components/books-container.php"; ?>
            <?php else: ?>
                <div class="start-page-content-message">
                    <?php if(isset($messages)): ?>
                        <?php foreach($messages as $message): ?>
                            <?= $message ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
    <?php
        include "components/encouragement-bar.php";
    ?>
    <section class="start-page-content-recently-added">
        <h1 class="start-page-content-top-books-title">Recently added</h1>
        <?php if (!empty($booksResult)): ?>
            <?php include "components/books-container.php"; ?>
        <?php else: ?>
            <div class="start-page-content-message">
                <?php if(isset($messages)): ?>
                    <?php foreach($messages as $message): ?>
                        <?= $message ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
        include "components/footer.php";
    ?>
</body>
