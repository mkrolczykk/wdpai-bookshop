<?php
// pobieramy przekazany parametr "bookId"
$product_id = $_GET['bookId'];

// pobieramy dane produktu z bazy danych na podstawie $product_id
// ...

// wyświetlamy szczegóły produktu
echo '<h1>' . $product_id . '</h1>';
echo '<p>' . $product_id . '</p>';
echo '<p>Cena: ' . $product_id . ' zł</p>';
