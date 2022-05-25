<?php
// print_r($_SERVER);
// exit;
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/connections/DB.php");

class User {

    function __construct(){

    }
    static public function getUser($identifier, $type){
        global $readDB;
        if($type === 'username'){
            $query = $readDB->prepare("SELECT * FROM users WHERE username=:username");
            $query->bindParam(':username', $identifier, PDO::PARAM_STR);
            $query->execute();
            $rowCount = $query->rowCount();
            if(!$rowCount){
                echo "error";
                exit;
            }
            $user = $query->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        // else if($type === 'id'){

        // }
    }
}