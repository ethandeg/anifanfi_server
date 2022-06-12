<?php
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/Request.php");
require_once($_SERVER["REDIRECT_ROOT_DIREC"]."/includes/Response.php");
class App {
    private $req;
    private $res;
    private $stack = array();
    // private $routeCalled = false;
    function __construct(){
        $this->req = new Request();
        $this->res = new Response();
    }
    public function get($route, ...$callBacks){
        if($this->req->method === 'GET' && $this->checkRouteMatch($route)){
            $callNum = count($callBacks);
            for($i = 0; $i<$callNum; $i++){
                if($i === $callNum -1){
                    $this->call($callBacks[$i]);
                } else {
                    $this->use($callBacks[$i]);
                }
            }
        }
    }
    public function post($route, ...$callBacks){
        if($this->req->method === 'POST' && $this->checkRouteMatch($route)){
                        $callNum = count($callBacks);
            for($i = 0; $i<$callNum; $i++){
                if($i === $callNum -1){
                    $this->call($callBacks[$i]);
                } else {
                    $this->use($callBacks[$i]);
                }
            }
        }
        
    }
    public function patch($route, ...$callBacks){
        if($this->req->method === 'PATCH' && $this->checkRouteMatch($route)){
                        $callNum = count($callBacks);
            for($i = 0; $i<$callNum; $i++){
                if($i === $callNum -1){
                    $this->call($callBacks[$i]);
                } else {
                    $this->use($callBacks[$i]);
                }
            }
        }
        
    }
    public function delete($route, ...$callBacks){
        if($this->req->method === 'DELETE' && $this->checkRouteMatch($route)){
                        $callNum = count($callBacks);
            for($i = 0; $i<$callNum; $i++){
                if($i === $callNum -1){
                    $this->call($callBacks[$i]);
                } else {
                    $this->use($callBacks[$i]);
                }
            }
        }
        
    }
    public function put($route, ...$callBacks){
        if($this->req->method === 'PUT' && $this->checkRouteMatch($route)){
                        $callNum = count($callBacks);
            for($i = 0; $i<$callNum; $i++){
                if($i === $callNum -1){
                    $this->call($callBacks[$i]);
                } else {
                    $this->use($callBacks[$i]);
                }
            }
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

    public function callStack(){
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