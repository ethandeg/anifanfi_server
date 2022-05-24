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
        if($this->req->method === 'GET' && $this->checkRouteMatch($route)){
            $callBack($this->req, $this->res);
            exit;
        }
        
    }
    public function post($route, $callBack){
        if($this->req->method === 'POST' && $this->checkRouteMatch($route)){
            $callBack($this->req, $this->res);
            exit;
        }
        
    }
    public function patch($route, $callBack){
        if($this->req->method === 'PATCH' && $this->checkRouteMatch($route)){
            $callBack($this->req, $this->res);
            exit;
        }
        
    }
    public function delete($route, $callBack){
        if($this->req->method === 'DELETE' && $this->checkRouteMatch($route)){
            $callBack($this->req, $this->res);
            exit;
        }
        
    }
    public function put($route, $callBack){
        if($this->req->method === 'PUT' && $this->checkRouteMatch($route)){
            $callBack($this->req, $this->res);
            exit;
        }
        
    }


    private function setParams($arr){
        $this->req->setParams($arr);
    }

    private function checkRouteMatch($route){
        $appRoute = explode('/', $route);
        $realRoute = explode('/',$this->req->url);
        $params = [];
        if(count($appRoute) !== count($realRoute)){
            $params = [];
            return false;
        }
        for($i = 0; $i < count($appRoute); $i++){
            $appParam = $appRoute[$i];
            $realParam = $realRoute[$i];
            if($appParam !== $realParam && $appParam[0] !== ":"){
                $params = [];
                return false;
            }
            if($appParam && $appParam[0] === ':'){
                $params[substr($appParam,1)] = $realParam;
            }
        }
        $this->setParams($params);
        return true;
    }
}