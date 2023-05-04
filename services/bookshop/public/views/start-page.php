<!DOCTYPE html>
<html lang="en">

<head>
    <title>Start page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/topbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="public/js/topbar.js"></script>
</head>
<body>
    <?php

    $title = "Start page";
    include "components/topbar.php";
    include "components/navbar.php";
    ?>
    <p><b>Visit T4Tutorials for more how to's and tutorials.</b></p>
    <p style='text-align: center;'>
        We are using two different files as header and footer.
    </p>
    <?php
    include "components/footer.php";
    ?>
</body>
