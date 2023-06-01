<?php

namespace Btx\Http;
use Btx\Http\Traits\StaticResponse;

class Response {
    use StaticResponse;

    public static function ok($text,$data = [],$append = null){
        return self::response200($text,$data,$append);
    }

    public static function badRequest($text,$dir = null){
        return self::response400($text,$dir);
    }

    public static function movedPermanently($text,$dir = null){
        return self::response301($text,$dir);
    }

    public static function unauthorized(){
        return self::response401();
    }

    public static function notFound($text,$dir = null){
        return self::response404($text,$dir);
    }

    public static function notAllowed($text,$dir = null){
        return self::response405($text,$dir);
    }

    public static function internalServerError($text,$data = []){
        return self::response500($text,$data);
    }
}