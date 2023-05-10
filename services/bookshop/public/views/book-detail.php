<!DOCTYPE html>
<html lang="en">

<head>
    <title>New books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/book-detail.css">
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
    <section class="book-detail-content">
        <?php if (!empty($bookResult)): ?>
            <div class="book-detail-content-book">
                <div class="book-detail-content-upper-section">
                    <div class="book-detail-content-upper-section-cover">
                        <div class="book-detail-content-upper-section-cover-image">
                            <img src="./public/img/mock-book-detail.png" class="book-detail-content-upper-section-cover-image" alt="Book cover">
                        </div>
                    </div>
                    <div class="book-detail-content-upper-section-book-details">
                        <h1>Title 1</h1>
                        <h2>A.J. Arberry</h2>
                        <h3>Summary</h3>
                        <p class="summary-text">
                            Release of Letraset sheets containing Lorem Ipsum passages,
                            and more recently with desktop publishing software.
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                        </p>
                        <h3>Price: <span>150 PLN</span></h3>
                        <h3>
                            Book available: <span>Yes</span>
                        </h3>
                        <div class="book-detail-section">
                            <div class="book-detail-section-info">
                                <h3>Product detail</h3>
                                <p>Pages: 344</p>
                                <p>Language: PL</p>
                                <p>Available since: 23.03.2017</p>
                            </div>
                            <div class="book-detail-section-buttons">
                                <div class="shopping-cart-button button">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                    <a href="/login">Add to cart</a>
                                </div>
                                <div class="favorite-button button">
                                    <i class="fa fa-heart fa-lg"></i>
                                    <a>Add to favorites</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="book-detail-content-down-section">
                    <h1>Book description</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 150
                        0s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.
                    </p>
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
        include "components/encouragement-bar.php";
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>
