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

class KmcenterCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $apiRes = Api::get("/kmcenter");
        return view("kmcenter/index", ['items'=> $apiRes->data]);
    }

    public function getAdd(){
        return view("kmcenter/add");
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_add($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("kmcenter");
        }
    }

    public function getEdit(){
        $req = Request::createFromGlobals();
        $id = $req->input('id');

        $item = Api::get("/kmcenter/".$id);

        return view("kmcenter/edit", ['item'=> $item]);
    }

    public function postEdit(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_edit($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("kmcenter");
        }
    }

    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");
        $res = \Unirest\Request::delete(Api::BASE_URL."/kmcenter/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb");
        return redirect("kmcenter");
    }

    // internal function
    public function _add(Request $req){
        $input = $req->input();
        $map = $req->file("kmcenter_map_pic");
        $input["kmcenter_map_pic"] = curl_file_create($map->getRealPath(), $map->getClientMimeType(), $map->getClientOriginalName());
        $res = \Unirest\Request::post(Api::BASE_URL."/kmcenter?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }

    public function _edit(Request $req){
        $input = $req->input();
        $id = $req->input('id');

        $res = \Unirest\Request::put(Api::BASE_URL."/kmcenter/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }
}