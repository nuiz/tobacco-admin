<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 20/2/2558
 * Time: 16:57
 */

namespace App\Http\Controllers;


use App\Http\Api;

class UserCTL extends Controller {
    public function getIndex(){
        $res = Api::get("/account");
        return view("user/index", ["items"=> $res->data]);
    }
}