<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin-dashboard.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/welcome-message.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/orders-container.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <div class="admin-dashboard-content">
        <?php
            include "components/welcome-message.php";
        ?>
        <section class="admin-dashboard-content-orders-history">
            <h1 class="page-section-title admin-dashboard-content-orders-history-title">Orders to be fulfilled</h1>
            <?php if (!empty($orders = $pendingOrdersResult)): ?>
                <?php include "components/orders-container.php"; ?>
            <?php else: ?>
                <div class="admin-dashboard-content-message">
                    No pending orders, we're all set up :)
                </div>
            <?php endif; ?>
        </section>
    </div>
    <?php
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
</body>