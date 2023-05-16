<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../common/constants/Role.php';

require_once __DIR__ . '/../model/request/SystemUserRegisterReq.php';
require_once __DIR__.'/../repository/SystemUserRepository.php';

class AddEmployeeController extends AppController {

    private $url;

    private SystemUserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->userRepository = new SystemUserRepository();
    }

    public function addEmployee() {

        if(AuthUtil::checkIfAuthorized($_SESSION["roleId"], Role::ROLE_ADMIN)) {

            if (!$this->isPost()) {

                return $this->render('add-employee');
            } else {

                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmedPassword = $_POST['confirmedPassword'];

                if ($password !== $confirmedPassword) {
                    return $this->render('add-employee', ['messages' => ['Please provide proper password']]);
                }

                if ($this->userRepository->checkIfEmailAlreadyExists($email)) {
                    return $this->render('add-employee', ['messages' => ['Given email already exists!']]);
                }

                if ($this->userRepository->checkIfUsernameAlreadyExists($username)) {
                    return $this->render('add-employee', ['messages' => ['Given username already exists!']]);
                }

                $user =
                    new SystemUserRegisterReq(
                        $name,
                        $surname,
                        $username,
                        $email,
                        password_hash($password, PASSWORD_DEFAULT),
                        "false",
                        Role::ROLE_EMPLOYEE);

                if ($this->userRepository->addSystemUser($user)) {
                    return $this->render('add-employee', ['messages' => ['Employee registration success!']]);
                } else {
                    return $this->render('add-employee', ['messages' => ['Registration fail! Try again in a while']]);
                }

            }
        }
        die("Wrong url!");
    }

}
