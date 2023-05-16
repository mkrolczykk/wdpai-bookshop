<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-book.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/welcome-message.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <section class="employee-add-book">
        <h1 class="page-section-title employee-add-book-title">Add book</h1>
        <div class=employee-add-book-container">
            <form id="register" class="register" action="addBook" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <fieldset>
                    <input name="title" placeholder="Book Title" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input name="author" placeholder="Book Author" type="text" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input name="summary" placeholder="Summary" type="text" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <input name="description" placeholder="Book Description" type="text" tabindex="4" required>
                </fieldset>
                <fieldset>
                    <input name="genre" placeholder="Category" type="text" tabindex="5" required>
                </fieldset>
                <fieldset>
                    <input name="numPages" placeholder="Number of pages" type="text" tabindex="6" required>
                </fieldset>
                <fieldset>
                    <input name="language" placeholder="Language (ex. pl, eng, en-US, fre)" type="text" tabindex="7" required>
                </fieldset>
                <fieldset>
                    <input name="price" placeholder="Price" type="text" tabindex="8" required>
                </fieldset>
                <fieldset>
                    <input name="currency" placeholder="Currency (ex. USD, PLN, EUR)" type="text" tabindex="9" required>
                </fieldset>
                <fieldset>
                    <input name="publisher" placeholder="Book publisher" type="text" tabindex="10" required>
                </fieldset>
                <fieldset>
                    <p>Upload Book cover</p>
                    <input type="file" name="file"/>
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" tabindex="11" data-submit="...Sending">Add Book</button>
                </fieldset>
            </form>
        </div>
    </section>
    <?php
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>