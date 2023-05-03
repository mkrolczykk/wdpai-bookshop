<?php

require_once __DIR__ . '/../common/utils/AuthUtil.php';

class EmployeeDashboardController extends AppController {

    public function employeeDashboard()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_EMPLOYEE)) {
            return $this->render('employee-dashboard');
        }
        die("Wrong url!");
    }

}