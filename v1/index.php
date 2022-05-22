<?php 
require_once("includes/App.php");
require_once("includes/Request.php");
// $App = new App();
// $App->get("/index/123", 'hey');
$req = new Request();
// print_r($req->query);
// print_r($req->body);
// $res->setStatus(200);
// $res->setSuccess(true);
// $res->addMessage("does this work?");
// $responseData['test'] = [1,2,3];
// $res->setData($responseData);
// $res->send();
// echo $req->url;
// print_r($_SERVER);
$req->checkUrlParamsExist();
exit;