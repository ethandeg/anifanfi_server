<?php 
require_once("includes/App.php");
// require_once("includes/Request.php");
$App = new App();

$App->get("/index/10/johnny", function($req, $res){
    echo "supposed to work";
});

$App->get("/index/:id/:name", function($req,$res){
    print_r($req->params);
});
exit;