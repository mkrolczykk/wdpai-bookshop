<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-employee.css">
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
    <section class="admin-add-employee">
        <h1 class="page-section-title admin-add-employee-title">Add Employee</h1>
        <div class=admin-add-employee-container">
            <form id="register" class="register" action="addEmployee" method="POST">
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
                    <input name="name" placeholder="Employee Name" type="text" tabindex="1" required>
                </fieldset>
                <fieldset>
                    <input name="surname" placeholder="Employee Surname" type="text" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input name="username" placeholder="Username" type="text" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <input name="email" placeholder="Email Address" type="email" tabindex="4" required>
                </fieldset>
                <fieldset>
                    <input name="password" placeholder="Employee Password" type="password" tabindex="5" required>
                </fieldset>
                <fieldset>
                    <input name="confirmedPassword" placeholder="Confirm Password" type="password" tabindex="6" required>
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" tabindex="7" data-submit="...Sending">Add</button>
                </fieldset>
            </form>
        </div>
    </section>
    <?php
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>