<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find results page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/find-results.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/books-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/encouragement-bar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <script type="text/javascript" src="public/js/topbar.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
    ?>
    <div style="background-color: #6c757d">
        <p style='text-align: center; color: #333333;' ><b>Visit T4Tutorials for more how to's and tutorials.</b></p>
        <p style='text-align: center; color: #333333;'>
            We are using two different files as header and footer.
        </p>
    </div>
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
    <?php
        include "components/encouragement-bar.php";
        include "components/footer.php";
    ?>
</body>
