
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>User dashboard</title>
    </head>
    <body>
        <h1>Welcome <?php echo $_SESSION["role"]; ?>!</h1>
        <a href="logout">Logout</a>
    </body>
</html>