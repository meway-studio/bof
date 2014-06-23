<?php
class MyErrorHandler {

    public static function errorToException($code, $message, $file, $line) {    
        throw new Exception($message, $code);        
    }

}