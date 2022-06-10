<?php
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/model/User.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/Token.php");

$App->get("/user/:username", function($req, $res){
    try {
        $username = $req->params['username'];
        $user = User::getUser($username, 'username');
        $res->json($user);
    } catch(Exception $e){
        $res->sendError($e);
    }

});

$App->post("/user", function($req,$res){
    // extract($req->body);
    try {
        $user = User::createUser($req->body);
        extract($user);
        $token = Token::createToken(['username' => $username, 'id' => $id]);
        $user['_token'] = $token;
        unset($user['password']);
        $res->addMessage("User successfully created");
        $res->setStatus(201);
        $res->json($user);
    } catch(Exception $e){
        $res->sendError($e);
    }

});

$App->post("/token", function($req, $res){
    try {
        $user = User::loginUser($req->body);
        extract($user);
        $token = Token::createToken(['username' => $username, 'id' => $id]);
        $user['_token'] = $token;
        unset($user['password']);
        $res->addMessage("Logged in Succesfully");
        $res->json($user);
    } catch(Exception $e){
        $res->sendError($e);
    }
});