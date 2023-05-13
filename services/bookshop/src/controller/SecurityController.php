<?php
session_start();

require_once 'AppController.php';
require_once __DIR__ . '/../model/request/SystemUserRegisterReq.php';
require_once __DIR__ . '/../model/response/SystemUserLoginResp.php';
require_once __DIR__.'/../repository/SystemUserRepository.php';

require_once __DIR__.'/../common/constants/Role.php';

class SecurityController extends AppController {

    private $url;

    private $loginRedirects = array(
        Role::ROLE_ADMIN => 'adminDashboard',
        Role::ROLE_EMPLOYEE => 'employeeDashboard',
        Role::ROLE_USER => 'userDashboard'
    );

    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->userRepository = new SystemUserRepository();
    }

    public function login() {

        if(empty($_SESSION["id"])) {

            if (!$this->isPost()) {
                return $this->render('login');
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userRepository->getSystemUser($email);

            if (!$user) {
                return $this->render('login', ['messages' => ['User not found!']]);
            }

            if ($user->getEmail() !== $email) {
                return $this->render('login', ['messages' => ['User with this email does not exist!']]);
            }

            if (!password_verify($password, $user->getPassword())) {
                return $this->render('login', ['messages' => ['Wrong password!']]);
            }

            $this->setLoginSession(true, $user->getUserId(), $user->getName(), $user->getUsername(), $user->getRoleId());

        }
        $this->redirectByAuthRoleId($_SESSION["roleId"]);
    }

    public function register() {

        if(!empty($_SESSION["id"])) {
            $this->redirectByAuthRoleId($_SESSION["roleId"]);
        } else {
            if (!$this->isPost()) {
                return $this->render('register');
            }

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmedPassword = $_POST['confirmedPassword'];
            $notifications = $_POST['notifications'];

            if ($password !== $confirmedPassword) {
                return $this->render('register', ['messages' => ['Please provide proper password']]);
            }

            if ($this->userRepository->checkIfEmailAlreadyExists($email)) {
                return $this->render('register', ['messages' => ['Given email already exists!']]);
            }

            if ($this->userRepository->checkIfUsernameAlreadyExists($username)) {
                return $this->render('register', ['messages' => ['Given username already exists!']]);
            }

            $user =
                new SystemUserRegisterReq(
                    $name,
                    $surname,
                    $username,
                    $email,
                    password_hash($password, PASSWORD_DEFAULT),
                    $notifications,
                    Role::ROLE_USER);

            if ($this->userRepository->addSystemUser($user)) {
                return $this->render('login', ['messages' => ['Registration success! You can log in now :)']]);
            } else {
                return $this->render('register', ['messages' => ['Registration fail! Try again in a while']]);
            }
        }
    }

    public function logout() {
        if (!$this->isPost()) {

            $_SESSION = [];
            session_unset();
            session_destroy();

            header("Location: {$this->url}/login");
        }
    }

    private function redirectByAuthRoleId($role)
    {

        switch ($role) {
            case Role::ROLE_ADMIN:
                $this->redirect($role, 'admin-dashboard');
                break;
            case Role::ROLE_EMPLOYEE:
                $this->redirect($role, 'employee-dashboard');
                break;
            case Role::ROLE_USER:
                $this->redirect($role, 'user-dashboard');
                break;
            default:
                return $this->render('login', ['messages' => ['Unrecognized user. Please log in again.']]);
        }
    }

    private function redirect(int $role, string $template) {

        if (isset($this->loginRedirects[$role])) {
            header("Location: {$this->url}/{$this->loginRedirects[$role]}");
            return $this->render($template);
        }
    }

    private function setLoginSession(
        string $authenticated,
        string $userId,
        string $name,
        string $username,
        int $role): void
    {
        $_SESSION["authenticated"] = $authenticated;
        $_SESSION["id"] = $userId;
        $_SESSION["name"] = $name;
        $_SESSION["username"] = $username;
        $_SESSION["roleId"] = $role;
        $_SESSION["currency"] = "USD";
    }

}