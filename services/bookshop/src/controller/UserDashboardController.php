<?php

require_once __DIR__ . '/../common/utils/AuthUtil.php';

class UserDashboardController extends AppController {

    public function userDashboard()
    {
        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_USER)) {
            return $this->render('user-dashboard');
        }
        die("Wrong url!");
    }

}