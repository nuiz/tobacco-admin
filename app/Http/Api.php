<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 24/2/2558
 * Time: 4:20
 */

namespace App\Http;


class Api {
//    const BASE_URL = "http://localhost/tobacco";
    const BASE_URL = "http://192.168.100.26/tobacco";
    public static function get($url){
        $res = \Unirest\Request::get(self::BASE_URL.$url);
        return $res->body;
    }
}