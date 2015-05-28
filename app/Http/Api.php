<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 24/2/2558
 * Time: 4:20
 */

namespace App\Http;


class Api {
    const BASE_URL = "http://127.0.0.1/tobacco";
//    const BASE_URL = "http://papangping.com/t1";
    public static function get($url){
        $res = \Unirest\Request::get(self::BASE_URL.$url);
        return $res->body;
    }
}