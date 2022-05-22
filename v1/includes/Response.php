<?php
class ResponseException extends Exception {}

class Response {
    private $success;
    private $httpStatusCode;
    private $messages = array();
    private $data;
    private $toCache = false;
    private $responseData = array();

    public function setSuccess($bool){
        $this->success = $bool;
    }
    public function setStatus($status){
        $this->httpStatusCode = $status;
    }
    public function addMessage($msg){
        $this->messages[] = $msg;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function isCache($bool){
        $this->toCache = $bool;
    }

    public function send(){
        header('Content-type: application/json;charset=utf-8');
        if($this->toCache){
            header('Cache-control: max-age=60');
        } else {
            header('Cache-control: no-cache, no-store');
        }
        if(($this->success !== false && $this->success !== true) || !is_numeric($this->httpStatusCode)){
            http_response_code(500);
            $this->responseData['statusCode'] = 500;
            $this->responseData['success'] = false;
            $this->addMessage("Response creation error");
            $this->responseData['messages'] = $this->messages;
        } else {
            http_response_code($this->httpStatusCode);
            $this->responseData['statusCode'] = $this->httpStatusCode;
            $this->responseData['messages'] = $this->messages;
            $this->responseData['data'] = $this->data;
        }

        echo json_encode($this->responseData);
    }

}