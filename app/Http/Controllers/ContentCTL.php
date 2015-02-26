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

class ContentCTL extends Controller {
    public function getIndex(){
        $res = Api::get("/content");
        return view("content/index", ['items'=> $res->data]);
    }

    public function getAddvideo(){
        $categories = Api::get("/category");
        return view("content/addvideo", ["categories"=> $categories->data]);
    }

    public function postAddvideo(){
        $req = Request::createFromGlobals();

        // user internal function add video
        $item = $this->_addVideo($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("content");
        }
    }

    public function getAddbook(){
        $categories = Api::get("/category");
        $book_type = Api::get("/book_type");
        return view("content/addbook", ["categories"=> $categories->data, "book_types"=> $book_type->data]);
    }

    public function postAddbook(){
        $req = Request::createFromGlobals();

        // user internal function add book
        $item = $this->_addBook($req);

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
        $res = \Unirest\Request::delete(Api::BASE_URL."/content/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb");
        return redirect("content");
    }

    // internal function
    public function _addVideo(Request $req){

        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */
        $video = $req->file("video");
        $video_thumb = $req->file("video_thumb");

        $input = $req->input();
        $input["video"] = curl_file_create($video->getRealPath(), $video->getClientMimeType(), $video->getClientOriginalName());
        $input["video_thumb"] = curl_file_create($video_thumb->getRealPath(), $video_thumb->getClientMimeType(), $video_thumb->getClientOriginalName());
        $input["content_type"] = "video";

        $res = \Unirest\Request::post(Api::BASE_URL."/content?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }

    public function _addBook(Request $req){

        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $book
         */
        $book = $req->file("book");
        $book_cover = $req->file("book_cover");

        $input = $req->input();
        $input["book"] = curl_file_create($book->getRealPath(), $book->getClientMimeType(), $book->getClientOriginalName());
        $input["book_cover"] = curl_file_create($book_cover->getRealPath(), $book_cover->getClientMimeType(), $book_cover->getClientOriginalName());
        $input["content_type"] = "book";

        $res = \Unirest\Request::post(Api::BASE_URL."/content?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }
}