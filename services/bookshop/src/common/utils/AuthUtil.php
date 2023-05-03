<?php

class AuthUtil {

    public static function checkIfAuthorized($userSessionRole, $expectedRole): bool {
        if($userSessionRole == $expectedRole) return true;
        else return false;
    }

}
