<?php
$cors = function($req, $res){
    if($req->method === 'OPTIONS'){
        try {
            $res = new Response();
            header("Access-Control-Allow-Methods: POST, OPTIONS, GET, DELETE, PUT, PATCH");
            header("Access-Control-Allow-Headers: Content-Type, authorization, content-type");
            header("Access-Control-Max-Age: 86400");
            $res->setStatus(200);
            $res->setSuccess(true);
            $res->send();
        } catch(Exception $e){
        }
}


};