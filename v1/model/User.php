<?php
// print_r($_SERVER);
// exit;
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/connections/DB.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/MySqlHelpers.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/ArrayMethods.php");

class User {

    function __construct(){

    }
    static public function getUser($identifier, $type){
        global $readDB;
        if($type === 'username'){
            $query = "SELECT * FROM users WHERE username = :username";
            $result = DB::query($readDB,$query,['username' => $identifier]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        // else if($type === 'id'){

        // }
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
        return $id;
    }
}