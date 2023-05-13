<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Favorite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/user-favorite.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/books-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <div class="user-favorite-content">
        <section class="user-favorite-content-favorite-books">
            <h1 class="page-section-title user-favorite-content-favorite-books-title">My favorite books</h1>
            <?php if (!empty($booksResult = $userFavoriteBooks)): ?>
                <?php include "components/books-container.php"; ?>
            <?php else: ?>
                <div class="user-favorite-content-message">
                    No favorite books :(
                </div>
            <?php endif; ?>
        </section>
    </div>
    <?php
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>