<?php
require_once($_SERVER['REDIRECT_ROOT_DIREC'] . "/includes/DB.php");
try {
    $writeDB = DB::connectWriteDB();
    $readDB = DB::connectReadDB();
} catch (PDOException $e){
    error_log("Database connection error - $e",0);
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Database connection error");
    $response->json();
    exit;
}