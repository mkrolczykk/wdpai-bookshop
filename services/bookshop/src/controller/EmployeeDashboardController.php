<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../repository/BookOrderRepository.php';
require_once __DIR__.'/../repository/SystemUserRepository.php';

class EmployeeDashboardController extends AppController {

    private $url;

    private BookOrderRepository $bookOrderRepository;

    private SystemUserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookOrderRepository = new BookOrderRepository();
        $this->userRepository = new SystemUserRepository();
    }

    public function employeeDashboard() {

        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_EMPLOYEE)) {

            $pendingOrdersResult = $this->bookOrderRepository->getOrders();
            $employees = $this->userRepository->getEmployees();

            if (!$this->isPost()) {

                return $this->render('employee-dashboard', [
                    'pendingOrdersResult' => $pendingOrdersResult,
                    'employees' => $employees
                ]);
            }
        }
        die("Wrong url!");
    }

}