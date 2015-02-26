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

class NewsCTL extends Controller {
    public function getIndex(){
        $apiRes = Api::get("/news");
        return view("news/index", ['items'=> $apiRes->data]);
    }

    public function getAdd(){
        $apiRes = Api::get("/news");
        return view("news/add");
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_add($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("content");
        }
    }

    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");
        $res = \Unirest\Request::delete(Api::BASE_URL."/news/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb");
        return redirect("news");
    }

    // internal function
    public function _add(Request $req){
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $img
         */
        $img = $req->file("news_image");

        $input = $req->input();
        $input["news_image"] = curl_file_create($img->getRealPath(), $img->getClientMimeType(), $img->getClientOriginalName());

        $res = \Unirest\Request::post(Api::BASE_URL."/news?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }
}