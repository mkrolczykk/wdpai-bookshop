<?php

require_once __DIR__ . '/../../../src/controller/api/ShoppingCartController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$shoppingCartController = new ShoppingCartController();

if(
    $_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_SESSION["authenticated"]) &&
    $_SESSION["roleId"] == Role::ROLE_USER) {

    echo $shoppingCartController->getShoppingCartItemsCount();
} else {
    echo json_encode(array("status" => 405 , "message" => 'Method not allowed'));
}