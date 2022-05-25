<?php
require_once("Request.php");
require_once("Response.php");
class App {
    private $req;
    private $res;
    private $stack = array();
    // private $routeCalled = false;
    function __construct(){
        $this->req = new Request();
        $this->res = new Response();
    }
    public function get($route, $callBack){
        if($this->req->method === 'GET' && $this->checkRouteMatch($route)){
            //update this to pass to callstack
            //only pass to callstack if !routecalled
            //set routedcalled = true
            $this->call($callBack);
        }
        
    }
    public function post($route, $callBack){
        if($this->req->method === 'POST' && $this->checkRouteMatch($route)){
            $this->call($callBack);
        }
        
    }
    public function patch($route, $callBack){
        if($this->req->method === 'PATCH' && $this->checkRouteMatch($route)){
            $this->call($callBack);
        }
        
    }
    public function delete($route, $callBack){
        if($this->req->method === 'DELETE' && $this->checkRouteMatch($route)){
            $this->call($callBack);
        }
        
    }
    public function put($route, $callBack){
        if($this->req->method === 'PUT' && $this->checkRouteMatch($route)){
            $this->call($callBack);
        }
        
    }

    public function use(...$params){
        $numArgs = func_num_args();
        if($numArgs === 2){
            if(gettype(func_get_arg(0)) === "string" && is_callable(func_get_arg(1))){
                array_push($this->stack, ['route' => func_get_arg(0), 'handle' => func_get_arg(1)]);
            }
        }
        elseif($numArgs === 1){
            if(is_callable(func_get_arg(0))){
                array_push($this->stack, ['route' => "", 'handle' => func_get_arg(0)]);
            }
        }
        // array_push($this->stack, ['route' => $route, 'handle' => $handle]);
    }

    public function continueNext($err=null){
        //grab err -> status
        //grab err -> message
        //pass those as parameters to next called function
                //maybe save paramters to response class?
    }

    private function call($func){
        //most likely remove this flag
        // if(!$this->routeCalled){
            // $this->setRouteCalled();
        $this->callStack();
        $func($this->req, $this->res);
        // }

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

    private function callStack(){
        $callRoute = $this->req->getUrl();
        foreach($this->stack as $func){
            //update this to pass in req,res,next params
            $route = $func['route'];
            $handle = $func['handle'];
            $routeLen = strlen($route);
            if($func['route'] === ""){
                $handle($this->req, $this->res);
            }

            elseif(substr($callRoute,0,$routeLen) === $route){
                $handle($this->req, $this->res);
            }
        }
    }

    private function setRouteCalled(){
        $this->routeCalled = true;
    }
}