<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find results page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/find-results.css">
    <link rel="stylesheet" type="text/css" href="public/css/books-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/footer.css">

    <script type="text/javascript" src="public/js/topbar.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
    ?>
    <div class="find-results-content">
        <?php if (!empty($booksResult)): ?>
            <h1 class="find-results-content-message">
                Search result: <?= count($booksResult) ?>
            </h1>
            <?php include "components/books-container.php"; ?>
        <?php else: ?>
            <div class="find-results-content-message">
                <?php if(isset($messages)): ?>
                    <?php foreach($messages as $message): ?>
                        <?= $message ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="find-results-encouragement">
        <div class="find-results-encouragement-text">
            <h2>Register for more possibilities</h2>
            <p>We'd love to help you find books you'll love.</p>
        </div>
        <div class="find-results-encouragement-button button">
            <a href="/register">Register</a>
        </div>
    </div>
    <?php include "components/footer.php"; ?>
</body>
