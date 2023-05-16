<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/book-detail.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
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
    <section class="book-detail-content">
        <?php if (!empty($bookResult)): ?>
            <div class="book-detail-content-book">
                <div class="book-detail-content-upper-section">
                    <div class="book-detail-content-upper-section-cover">
                        <div class="book-detail-content-upper-section-cover-image">
                            <?php
                                $bookTitle = strtolower(str_replace(' ', '-', $bookResult->getTitle()));
                                $coverImagePath = "./public/img/books/{$bookTitle}.png";

                                if (file_exists($coverImagePath)) {
                                    echo '<img src="' . $coverImagePath . '" class="book-detail-content-upper-section-cover-image" alt="Book cover">';
                                } else {
                                    echo '<img src="./public/img/books/mock-book-cover.png" class="book-detail-content-upper-section-cover-image" alt="Book cover">';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="book-detail-content-upper-section-book-details">
                        <h1><?php echo $bookResult->getTitle() ?></h1>
                        <h2><?php echo $bookResult->getAuthors() ?></h2>
                        <h3>Category: <?php echo $bookResult->getCategory() ?></h3>
                        <h3>Summary</h3>
                        <p class="summary-text"><?php echo $bookResult->getSummary() ?></p>
                        <h3>
                            Price: <span><?= $bookResult->getPrice(); echo ' '; echo $bookResult->getCurrency();?></span>, available: <span><i class="fa fa-check fa-lg" aria-hidden="true"></i></span>
                        </h3>
                        <div class="book-detail-section">
                            <div class="book-detail-section-info">
                                <h3>Product detail</h3>
                                <p>Pages: <?php echo $bookResult->getNumPages() ?></p>
                                <p>Languages: <?php echo $bookResult->getLanguages() ?></p>
                                <p>Added at: <?php echo $bookResult->getAddedAt() ?></p>
                            </div>
                            <div class="book-detail-section-buttons">
                                <span>Amount</span>
                                <div class="amount-button">
                                    <i class="minus fa fa-minus fa-sm"></i>
                                    <span class="amount">1</span>
                                    <i class="plus fa fa-plus fa-sm"></i>
                                </div>
                                <?php if (!isset($_SESSION["authenticated"])): ?>
                                    <div class="shopping-cart-button button" onclick="redirectToLogin()">
                                        <i class="fa fa-shopping-cart"></i>
                                        <a href="/login">Add to cart</a>
                                    </div>
                                    <div class="favorite-button button" onclick="redirectToLogin()">
                                        <i class="fa fa-heart fa-lg"></i>
                                        <a href="/login">Add to favorites</a>
                                    </div>
                                <?php elseif ($_SESSION["authenticated"] &&
                                $_SESSION["roleId"] === Role::ROLE_USER): ?>
                                    <div class="shopping-cart-button button" onclick="addToShoppingCart('<?php echo $bookResult->getBookId(); ?>')">
                                        <i class="fa fa-shopping-cart"></i>
                                        <a>Add to cart</a>
                                    </div>
                                    <?php
                                        $bookId = $bookResult->getBookId();
                                        $isFavorite = false;

                                        foreach ($favoriteBooksResult as $favoriteBook) {
                                            if ($favoriteBook->getBookId() === $bookId) {
                                                $isFavorite = true;
                                                break;
                                            }
                                        }
                                    ?>
                                    <div class="favorite-button button" onclick="<?php echo $isFavorite ? "removeFromFavorites('$bookId')" : "addToFavorites('$bookId')" ?>">
                                        <?php if ($isFavorite): ?>
                                            <i class="fa fa-thumbs-down fa-lg"></i>
                                            <a>Remove from favorites</a>
                                        <?php else: ?>
                                            <i class="fa fa-heart fa-lg"></i>
                                            <a>Add to favorites</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="book-detail-content-down-section">
                    <h1>Book description</h1>
                    <p><?php echo $bookResult->getDescription() ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="book-detail-content-message">
                <?php if(isset($messages)): ?>
                    <?php foreach($messages as $message): ?>
                        <?= $message ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
        if (!isset($_SESSION["authenticated"])) {
            include "components/encouragement-bar.php";
        }
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
    <script type="text/javascript" src="public/js/cart/amount-button.js"></script>
    <script type="text/javascript" src="public/js/cart/add-to-shopping-cart.js"></script>
    <script type="text/javascript" src="public/js/favorites/add-to-favorites.js"></script>
    <script type="text/javascript" src="public/js/favorites/remove-from-favorites.js"></script>
    <script type="text/javascript" src="public/js/redirect-to-login.js"></script>
</body>