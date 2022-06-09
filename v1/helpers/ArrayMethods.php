<?php

class ArrayMethods {
    public static function any($arr){
        foreach($arr as $el){
            if(!$el){
                return false;
            }
        }
        return true;
    }
}