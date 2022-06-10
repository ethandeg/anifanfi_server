<?php


    $grabJWT = function($req, $res){
        $token = null;
        if(isset($req->body['_token']) && $req->body['_token']){
            $token = $req->body['_token'];
        }
        if(isset($req->params['_token']) && $req->params['_token']){
            $token = $req->params['_token'];
        }

        if(isset($req->query['_token']) && $req->query['_token']){
            $token = $req->query['_token'];
        }
        if(isset($req->headers['_token']) && $req->headers['_token']){
            $token = $req->headers['_token'];
        }

        if($token){
            $req->locals['token'] = $token;
        }
    };

