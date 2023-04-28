<?php

class SystemUserRegisterReq {

    private $name;

    private $surname;

    private $username;

    private $email;

    private $password;

    private $notifications;

    private $roleId;

    public function __construct($name, $surname, $username, $email, $password, $notifications, $roleId)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->notifications = $notifications;
        $this->roleId = $roleId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNotifications()
    {
        return $this->notifications;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }


}