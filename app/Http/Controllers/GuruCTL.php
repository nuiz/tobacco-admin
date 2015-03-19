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

class GuruCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $apiRes = Api::get("/guru");
        return view("guru/index", ['items'=> $apiRes->data]);
    }

    public function getAdd(){
        $resCat = Api::get("/guru/category?limit=100");
        $resUser = Api::get("/account/user");
        return view("guru/add", ['category'=> $resCat->data, 'users'=> $resUser->data]);
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_add($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("guru");
        }
    }

    public function getEdit(){
        $req = Request::createFromGlobals();
        $id = $req->input('id');

        $item = Api::get("/guru/".$id);
        $resCat = Api::get("/guru/category?limit=100");

        return view("guru/edit", ['category'=> $resCat->data, 'item'=> $item]);
    }

    public function postEdit(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_edit($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("guru");
        }
    }

    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");
        $res = \Unirest\Request::delete(Api::BASE_URL."/guru/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb");
        return redirect("guru");
    }

    // internal function
    public function _add(Request $req){
        $input = $req->input();
        $res = \Unirest\Request::post(Api::BASE_URL."/guru?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }

    public function _edit(Request $req){
        $input = $req->input();
        $id = $req->input('id');

        $res = \Unirest\Request::put(Api::BASE_URL."/guru/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }
}