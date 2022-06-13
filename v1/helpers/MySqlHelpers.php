<?php
class MySqlHelpers {
    public static function hashPassword($pass){
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        return $hashedPassword;
    }

    public static function verifyPassword($pass, $dbPass){
        if(password_verify($pass, $dbPass)){
            return true;
        }
        return false;
    }

 
}