<?php

require_once __DIR__ . '/../../../src/controller/api/FavoriteBooksController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$favoriteBooksController = new FavoriteBooksController();

if(
    $_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_SESSION["authenticated"]) &&
    $_SESSION["roleId"] == Role::ROLE_USER) {

    echo $favoriteBooksController->getFavoriteBooksCount();
} else {
    echo json_encode(array("status" => 405 , "message" => 'Method not allowed'));
}