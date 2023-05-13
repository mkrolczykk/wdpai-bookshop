<!DOCTYPE html>
<html lang="en">

<head>
    <title>New books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/new-books.css">
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
        <section class="new-books-content">
            <h1 class="page-section-title new-books-content-title">Recently added books</h1>
            <?php if (!empty($booksResult = $recentlyAddedBooks)): ?>
                <?php include "components/books-container.php"; ?>
            <?php else: ?>
                <div class="new-books-content-message">
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
</body>