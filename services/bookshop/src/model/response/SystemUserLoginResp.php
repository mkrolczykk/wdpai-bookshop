<?php

class SystemUserLoginResp {

    private $userId;

    private $name;

    private $surname;

    private $username;

    private $email;

    private $password;

    private $roleId;


    public function __construct($userId, $name, $surname, $username, $email, $password, $roleId) {
        $this->userId = $userId;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roleId = $roleId;
    }

    public function getUserId()
    {
        return $this->userId;
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

    public function getRoleId()
    {
        return $this->roleId;
    }

}