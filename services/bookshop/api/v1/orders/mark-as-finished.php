<?php

require_once __DIR__ . '/../../../src/controller/api/OrderController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$orderController = new OrderController();

if(
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    $_SESSION["authenticated"] &&
    ($_SESSION["roleId"] == Role::ROLE_ADMIN || $_SESSION["roleId"] == Role::ROLE_EMPLOYEE)) {

    $data = json_decode(file_get_contents('php://input'), true);

    echo $orderController->updateOrderStatusToPendingDelivery($data['orderId']);
} else {
    echo json_encode(array("status" => 405 , "message" => 'Method not allowed'));
}