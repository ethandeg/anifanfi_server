<?php
class RequestException extends Exception {}
class Request{
    public $query;
    public $body;
    public $url;
    public $params;
    function __construct(){
        $this->url = $this->createUrl();
        $this->body = $this->getBody();
        $this->query=$_GET;
    }

    private function createUrl(){
        $queryString = "?".$_SERVER['QUERY_STRING'];
        $url = str_replace($queryString, "", $_SERVER['REQUEST_URI']);
        $url = str_replace($_SERVER['REDIRECT_ROOT_PATH'],"", $url);
        return $url;
    }

    public function checkUrlParamsExist(){
        $paramData = [];
        $params = explode("/", $this->url);
        
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
}