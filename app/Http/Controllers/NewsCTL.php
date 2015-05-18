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

class NewsCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $u = Session::get("userlogin");
        $res = \Unirest\Request::delete(Api::BASE_URL."/news/{$id}?auth_token=".$u->auth_token);
        return redirect("news");
    }

    // internal function
    public function _add(Request $req){
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $img
         */
        $img = $req->file("news_cover");

        $input = $req->input();
        $input["news_cover"] = curl_file_create($img->getRealPath(), $img->getClientMimeType(), $img->getClientOriginalName());

        $images = $req->file("news_images");
        $input["news_images"] = [];
        if(!is_null($images) && count($images) > 0){
            foreach($images as $key=> $file){
                if(is_null($file))
                    break;

                $input["news_images"][$key] = curl_file_create($file->getRealPath(), $file->getClientMimeType(), $file->getClientOriginalName());
            }
        }

        $u = Session::get("userlogin");

        $res = \Unirest\Request::post(Api::BASE_URL."/news?auth_token=".$u->auth_token, [], $input);
        return $res->body;
    }

    public function getEdit(){
        $req = Request::createFromGlobals();
        $news = Api::get("/news/".$req->input("id"));
        return view("news/edit", ["news"=> $news]);
    }

    public function postEdit(){
        $req = Request::createFromGlobals();

        // user internal function edit
        $item = $this->_edit($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("news");
        }
    }

    public function postImages(){
        $req = Request::createFromGlobals();
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */

        $id = $req->input("id");

        $u = Session::get("userlogin");
        $input = $req->input();
        $images = $req->file("news_images");
        $input["news_images"] = [];
        if(!is_null($images) && count($images) > 0){
            foreach($images as $key=> $file){
                if(is_null($file))
                    break;

                $input["news_images"][$key] = curl_file_create($file->getRealPath(), $file->getClientMimeType(), $file->getClientOriginalName());
            }
        }

        $res = \Unirest\Request::post(Api::BASE_URL."/news/{$id}/images?auth_token=".$u->auth_token, [], $input);
        return json_encode($res->body);
    }

    public function getRemoveimages(){
        $req = Request::createFromGlobals();
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */

        $id = $req->input("news_id");

        $u = Session::get("userlogin");
        $input = $req->input();

        $input['auth_token'] = $u->auth_token;
        $query = http_build_query($input);

        $res = \Unirest\Request::delete(Api::BASE_URL."/news/{$id}/images?".$query);
        return json_encode($res->body);
    }

    public function _edit(Request $req){
        $input = $req->input();

        $img = $req->file("news_cover");
        if(!is_null($img)){
            $input["news_cover"] = curl_file_create($img->getRealPath(), $img->getClientMimeType(), $img->getClientOriginalName());
        }

        $id = $req->input("id");

        $u = Session::get("userlogin");
        $res = \Unirest\Request::put(Api::BASE_URL."/news/{$id}?auth_token=".$u->auth_token, [], $input);
        return $res->body;
    }

}