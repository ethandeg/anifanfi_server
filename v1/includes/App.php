<?php
require_once("Request.php");
require_once("Response.php");
class App {
    private $req;
    private $res;

    function __construct(){
        $this->req = new Request();
        $this->res = new Response();
    }
    public function get($route, $callBack){
        if($route === $this->req->url){
            echo "They match!";
        }
    }
}