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
use Illuminate\Support\Facades\Session;

class UserClusterCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $res = Api::get("/account/cluster");
        return view("user/cluster/index", ["items"=> $res->data]);
    }

    public function getAdd(){
        return view("user/cluster/add");
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        $u = Session::get("userlogin");
        $res = \Unirest\Request::post(Api::BASE_URL."/account/cluster?auth_token=".$u->auth_token, [], $req->input());
        return json_encode($res->body);
    }

    public function postGenerate(){
        $req = Request::createFromGlobals();

        $u = Session::get("userlogin");
        $res = \Unirest\Request::post(Api::BASE_URL."/account/cluster?auth_token=".$u->auth_token, [], $req->input());
        return json_encode($res->body);
    }
}