<?php 
require_once("includes/App.php");
require_once("includes/DB.php");
// require_once("includes/Request.php");
$App = new App();

try {
    $writeDB = DB::connectWriteDB();
    $readDB = DB::connectReadDB();
} catch (PDOException $e){
    error_log("Database connection error - $e",0);
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Database connection error");
    $response->send();
    exit;
}

$App->get("/index/1/johnny", function($req, $res){
    echo "supposed to not work";
});

$App->get("/index/:id/:name", function($req,$res){
    print_r($req->params);
});
exit;