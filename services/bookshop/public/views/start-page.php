<!DOCTYPE html>
<html lang="en">

<head>
<!--    <title>--><?php //global $title; echo $title; ?><!--</title>-->
    <title>Start page</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/topbar.css">
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
