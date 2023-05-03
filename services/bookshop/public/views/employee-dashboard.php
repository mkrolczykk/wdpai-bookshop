
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Employee dashboard</title>
    </head>
    <body>
        <h1>Welcome <?php echo $_SESSION["name"]; echo $_SESSION["roleId"]?>!</h1>
        <a href="logout">Logout</a>
    </body>
</html>