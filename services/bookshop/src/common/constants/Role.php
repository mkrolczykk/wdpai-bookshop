<?php

class Role {

    const ROLE_ADMIN = 1;

    const ROLE_EMPLOYEE = 2;

    const ROLE_USER = 3;

    public static function getRoleName($role): string
    {
        switch ($role) {
            case self::ROLE_ADMIN:
                return 'ROLE_ADMIN';
            case self::ROLE_EMPLOYEE:
                return 'ROLE_EMPLOYEE';
            case self::ROLE_USER:
                return 'ROLE_USER';
            default:
                return '';
        }
    }
}