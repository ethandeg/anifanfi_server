<?php
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/model/User.php");
$App->get("/user/:username", function($req, $res){
    $username = $req->params['username'];
    $user = User::getUser($username, 'username');
    $res->json($user);
});

$App->post("/user", function($req,$res){
    // extract($req->body);
    $id = User::createUser($req->body);
    $res->json(['id' => $id]);
});