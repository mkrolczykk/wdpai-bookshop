
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>User dashboard</title>
    </head>
    <body>
        <h1>Welcome <?php echo $_SESSION["name"]; echo $_SESSION["roleId"]?>!</h1>
        <a href="bookDetail?bookId=<?php echo 'product-1'; ?>"><?php echo 'product-1'; ?></a>
        <a href="bookDetail?bookId=<?php echo 'product-2'; ?>"><?php echo 'product-2'; ?></a>
        <a href="logout">Logout</a>
    </body>
</html>