<!DOCTYPE html>
<html lang="en">

<head>
    <title>Find results page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="public/js/topbar.js"></script>
</head>
<body>
    <?php

    include "components/topbar.php";
    include "components/navbar.php";
    ?>
    <div style="background-color: #6c757d">
        <section class="books">
            <?php if (!empty($findResult)): ?>
                <?php foreach ($findResult as $book): ?>
                    <h1>Search result: </h1>
                    <div id="<?= $book->getTitle(); ?>">
                        <?php
                        if ($book->getCover()) {
                            echo '<img src="data:image/png;base64,' . base64_encode(stream_get_contents($book->getCover())) . '" alt="Book cover">';
                        } else {
                            echo '<img src="public/img/default-cover.png">';
                        }
                        ?>
                        <div>
                            <h2><?= $book->getTitle(); ?></h2>
                            <p><?= $book->getAuthors(); ?></p>
                            <div class="social-section">
                                <i class="fas fa-heart"> <?= $book->getPrice(); ?></i>
                                <i class="fas fa-minus-square"> <?= $book->getCurrency(); ?></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            <?php endif; ?>
        </section>

    </div>
</body>
