<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 20/2/2558
 * Time: 16:57
 */

namespace App\Http\Controllers;


use App\Http\Api;
use App\Http\Requests\Request;

class UserWriterCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $res = Api::get("/account/writer");
        return view("user/writer/index", ["items"=> $res->data]);
    }

    public function getAdd(){
        $res = Api::get("/account/user");
        return view("user/writer/add", ["users"=> $res->data]);
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        $res = \Unirest\Request::post(Api::BASE_URL."/account/upwriter", [], $req->input());
        return json_encode($res->body);
    }
}