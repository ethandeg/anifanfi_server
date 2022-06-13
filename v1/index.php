<?php 
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/App.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/Logger.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/middleware/AuthMiddleware.php");
require_once($_SERVER['REDIRECT_ROOT_DIREC']."/middleware/cors.php");
// require_once("includes/Request.php");
$App = new App();
$App->use($cors);

$App->use($grabJWT);

require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/routes/auth.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/routes/player.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/routes/class.php");
// $App->use('/index',function($req, $res){
//     echo "hello, world";
// });
// $App->use('/index',function($req, $res){
//     echo "HERE IS THE SECOND USE";
// });

// $App->get("/user/:username", function($req, $res){
//     $username = $req->params['username'];
//     $user = User::getUser($username, 'username');
//     $res->json($user);
// });
$App->get("/index/:id/:name", function($req,$res){
    $res->json(['msg' => 'hello']);
});

$App->get("/index/1/johnny", function($req, $res){
    echo "supposed to not work";
});

$App->callStack();
exit;