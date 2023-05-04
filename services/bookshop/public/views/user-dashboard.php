
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>User dashboard</title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/topbar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="public/js/topbar.js"></script>
    </head>
    <body>
        <?php include "components/topbar.php"; ?>
        <h1>Welcome <?php echo $_SESSION["name"]; echo $_SESSION["roleId"]?>!</h1>
        <a href="bookDetail?bookId=<?php echo 'product-1'; ?>"><?php echo 'product-1'; ?></a>
        <a href="bookDetail?bookId=<?php echo 'product-2'; ?>"><?php echo 'product-2'; ?></a>
        <a href="logout">Logout</a>
    </body>
</html>