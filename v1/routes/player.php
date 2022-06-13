<?php
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/model/Player.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/middleware/AuthMiddleware.php");


$App->get("/player/:id", function ($req, $res){
    try {
        $id = $req->params['id'];
        $player = Player::getPlayerById($id);
        $res->json($player);
    } catch(Exception $e){
        $res->sendError($e);
    }

});