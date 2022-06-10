<?php

require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/connections/DB.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/MySqlHelpers.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/ArrayMethods.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/AppException.php");

class User {

    function __construct(){

    }
    static public function getUser($identifier, $type){
        global $readDB;
        if($type === 'username'){
            $query = "SELECT * FROM users WHERE username = :username";
            $result = DB::query($readDB,$query,['username' => $identifier]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                throw new BadRequestException("Cannot find user with username of $identifier");
            }
            return $user;
        }
        else if($type === 'id'){
            $query = "SELECT * FROM users WHERE id = :id";
            $result = DB::query($readDB,$query,['id' => $identifier]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                throw new BadRequestException("Cannot find user with id of $identifier");
            }
            return $user;
        }
    }

    static public function createUser($userInfo){
        global $writeDB;
        extract($userInfo);
        $userInfo['password'] = MySqlHelpers::hashPassword($password);
        $query = "INSERT INTO users (username,password, email) VALUES (:username,:password, :email)";
        DB::query($writeDB,$query, $userInfo);
        $id = $writeDB->lastInsertId();
        if(!$id){
            throw new Exception("no id");
        }
        $user = self::getUser($id, 'id');
        return $user;
    }

    static public function loginUser($userInfo){
        extract($userInfo);
        $user = self::getUser($username, 'username');
        $hashPass = $user['password'];
        if(!password_verify($password,$hashPass)){
            throw new BadRequestException("Invalid login credentials");
        }
        return $user;
    }
}