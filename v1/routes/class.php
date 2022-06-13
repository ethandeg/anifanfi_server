<?php
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/model/Class.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/middleware/AuthMiddleware.php");

$App->get("/classes", function ($req, $res){
    try {
        $classes = Classes::getAllClasses();
        $res->json($classes);
    } catch(Exception $e){
        $res->sendError($e);
    }
});