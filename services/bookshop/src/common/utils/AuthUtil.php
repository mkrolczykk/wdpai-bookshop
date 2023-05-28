<?php

class AuthUtil {

    public static function checkIfAuthorized($userSessionRole, $expectedRole): bool {
        return $userSessionRole === $expectedRole;
    }

}
