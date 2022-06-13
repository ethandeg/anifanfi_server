<?php
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/connections/DB.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/MySqlHelpers.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/helpers/ArrayMethods.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/AppException.php");

class Player{
    function __construct(){

    }

    public static function getPlayerById($id){
        global $readDB;
        $query = "SELECT * FROM player JOIN class ON player.class_id=class.id WHERE player.id = :id";
        $result = DB::query($readDB,$query,['id' => $id]);
        $player = $result->fetch(PDO::FETCH_ASSOC);
        if(!$player){
            throw new BadRequestError("Cannot find player with id of: $id");
        }
        return $player;
    }
}