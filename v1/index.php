<?php 
require_once("includes/App.php");
require_once("model/User.php");
// require_once("includes/Request.php");
$App = new App();

// $App->use('/index',function($req, $res){
//     echo "hello, world";
// });
// $App->use('/index',function($req, $res){
//     echo "HERE IS THE SECOND USE";
// });

$App->get("/user/:username", function($req, $res){
    $username = $req->params['username'];
    $user = User::getUser($username, 'username');
    $res->json($user);
});

$App->get("/index/:id/:name", function($req,$res){
    $res->json(['msg' => 'hello']);
});

$App->get("/index/1/johnny", function($req, $res){
    echo "supposed to not work";
});
exit;