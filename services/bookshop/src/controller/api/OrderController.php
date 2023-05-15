<?php
session_start();

require_once __DIR__.'/../../common/constants/Role.php';
require_once __DIR__.'/../../repository/BookOrderRepository.php';

class OrderController {

    private BookOrderRepository $bookOrderRepository;

    public function __construct() {
        $this->bookOrderRepository = new BookOrderRepository();
    }

    public function updateOrderStatusToPendingDelivery(int $orderId): string {

        if($this->bookOrderRepository->updateOrderStatusToPendingDelivery($orderId)) {
            $result = array("status" => 200 , "message" => "Order status updated!");
        } else {
            $result = array("status" => 400 , "message" => "Order status already updated");
        }

        return json_encode($result);
    }

    public function assignEmployeeToOrder(string $orderId, string $employeeId): string {

        if(
            $_SESSION["roleId"] == Role::ROLE_ADMIN ||
            ($_SESSION["roleId"] == Role::ROLE_EMPLOYEE && $_SESSION["id"] == $employeeId)) {

            if ($this->bookOrderRepository->assignEmployeeToOrder($orderId, $employeeId)) {
                $result = array("status" => 200, "message" => "Employee assigned to the order!");
            } else {
                $result = array("status" => 400, "message" => "Employee cannot be applied to the order");
            }

            return json_encode($result);
        } else {
            return json_encode(array("status" => 400, "message" => "Operation not allowed"));
        }
    }
}
