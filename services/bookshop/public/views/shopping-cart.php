<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/shopping-cart.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/topbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/components/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php
        include "components/topbar.php";
        include "components/navbar.php";
        include "components/menu.php";
    ?>
    <div class="shopping-cart-content">
            <h1 class="page-section-title shopping-cart-content-title">Shopping cart</h1>
        <?php if (!empty($shoppingCartResult)): ?>
            <table class="shopping-cart-table">
                <thead>
                <tr class="cart-header">
                    <th>Book</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>For all</th>
                    <th id="currency">Currency</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($shoppingCartResult as $item): ?>
                    <tr class="cart-row">
                        <td>
                            <div class="cart-row-book">
                                <div class="cart-row-book-content">
                                    <img src="public/img/books/<?php echo str_replace(' ', '-', strtolower($item->getBookName())); ?>.png" alt="Book Cover" onerror="this.src='public/img/books/mock-book-detail-cover.png'" class="book-cover">
                                    <a href="bookDetail?bookTitle=<?php echo str_replace(' ', '-', $item->getBookName()); ?>">
                                        <?php echo $item->getBookName(); ?>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="price"><?php echo $item->getPrice(); ?></td>
                        <td class="cart-button">
                            <div class="amount-button">
                                <i class="minus fa fa-minus fa-sm" data-book-id="<?php echo $item->getBookId(); ?>"></i>
                                <span class="amount"><?php echo $item->getAmount(); ?></span>
                                <i class="plus fa fa-plus fa-sm" data-book-id="<?php echo $item->getBookId(); ?>"></i>
                            </div>
                        </td>
                        <td class="total"><?php echo $item->getTotal(); ?></td>
                        <td id="currency"><?php echo $item->getCurrency(); ?></td>
                        <td>
                            <button class="remove-button" data-item-id="<?php echo $item->getBookName(); ?>">
                                <i class="fa fa-times fa-lg"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr id="cart-total-start" class="cart-total-row">
                    <td colspan="3"></td>
                    <td class="cart-shipping" colspan="2">
                        Shipping cost: <span id="shippingCost">Free</span></td>
                    <td></td>
                </tr>
                <tr class="cart-total-row">
                    <td colspan="3"></td>
                    <td class="cart-total" colspan="2">
                        Total: <span id="cartTotalAmount"><?php echo "{$totalAmount}"?></span><span id="cartTotalCurrency"><?php echo " {$shoppingCartResult[0]->getCurrency()}"; ?></span></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <div class="shopping-cart-button button">
                <a href="">Submit order</a>
            </div>

        <?php else: ?>
            <div class="shopping-cart-content-message">
                Shopping cart empty
            </div>
        <?php endif; ?>
    </div>
    <?php
        include "components/footer.php";
    ?>
    <script type="text/javascript" src="public/js/scroll-top.js"></script>
    <script type="text/javascript" src="public/js/cart/shopping-cart.js"></script>
</body>