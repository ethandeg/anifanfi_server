<?php
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/connections/DB.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/MySqlHelpers.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/ArrayMethods.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/AppException.php");

class Classes {
    function __construct(){

    }

    public static function getAllClasses(){
        global $readDB;
        $query = "SELECT * FROM class";
        $result = DB::query($readDB,$query);
        $classes = $result->fetchAll(PDO::FETCH_ASSOC);
        return $classes;
    }
}