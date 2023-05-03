<?php

require_once __DIR__ . '/../common/utils/AuthUtil.php';

class AdminDashboardController extends AppController {

    public function adminDashboard()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_ADMIN)) {
            return $this->render('admin-dashboard');
        }
        die("Wrong url!");
    }

}