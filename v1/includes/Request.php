<?php
class RequestException extends Exception {}
class Request{
    public $query;
    public $body;
    public $url;
    public $params;
    public $method;
    public $locals = [];
    public $headers;
    function __construct(){
        $this->url = $this->createUrl();
        $this->body = $this->getBody();
        $this->query=$_GET;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders();
    }

    private function createUrl(){
        $queryString = "?".$_SERVER['QUERY_STRING'];
        $url = str_replace($queryString, "", $_SERVER['REQUEST_URI']);
        $url = str_replace($_SERVER['REDIRECT_ROOT_PATH'],"", $url);
        return $url;
    }


    private function getBody(){
        $rawData = file_get_contents("php://input");
        if(!empty($rawData)){
            if(!$jsonData = json_decode($rawData,true)){
                throw new RequestException("JSON Body is not valid json");
            }
            return $jsonData;
        }
        return null;

    }

    public function setParams($arr){
        $this->params = $arr;
    }


    public function getUrl(){
        return $this->url;
    }

    

}