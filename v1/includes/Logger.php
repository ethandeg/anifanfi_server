<?php

class Logger {
    private $name;
    private $path;
    function __construct($name, $path=null){
        $this->name = $name;
        if($path){
            $this->path = "$path/$name";
        } else {
            $this->path = $_SERVER["REDIRECT_ROOT_DIREC"]."/logs/$this->name.log";
        }
    }

    public function log($data){
        if(file_exists($this->path)){
            $myfile = fopen($this->path, "a") or die("Unable to open file!");
            fwrite($myfile, "$data\r\n");
            fclose($myfile);
        } else {
            $myfile = fopen($this->path, "w") or die("Unable to open file!");
            fwrite($myfile, "$data\r\n");
            fclose($myfile);
        }

    }



}