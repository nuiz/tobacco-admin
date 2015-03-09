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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $res = Api::get("/content");
        return view("content/index", ['items'=> $res->data]);
    }

    public function getAddvideo(){
        $category_tree = Api::get("/category/tree");
        return view("content/addvideo", ["category_tree"=> $category_tree]);
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
        $category_tree = Api::get("/category/tree");
        $book_type = Api::get("/book_type");
        return view("content/addbook", ["category_tree"=> $category_tree, "book_types"=> $book_type->data]);
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
        $videos = $req->file("videos");
        $videos_thumb = $req->file("videos_thumb");
        $attach_files = $req->file("attach_files");

        $input = $req->input();
        $input["videos"] = [];
        foreach($videos as $key=> $video){
            $input["videos"][$key] = curl_file_create($video->getRealPath(), $video->getClientMimeType(), $video->getClientOriginalName());
        }
        $input["videos_thumb"] = [];
        foreach($videos_thumb as $key=> $video_thumb){
            $input["videos_thumb"][$key] = curl_file_create($video_thumb->getRealPath(), $video_thumb->getClientMimeType(), $video_thumb->getClientOriginalName());
        }
        $input["attach_files"] = [];
        if(!is_null($attach_files) && count($attach_files > 0)){
            foreach($attach_files as $key=> $attach_file){
                $input["attach_files"][$key] = curl_file_create($attach_file->getRealPath(), $attach_file->getClientMimeType(), $attach_file->getClientOriginalName());
            }
        }

//        $input["video"] = curl_file_create($video->getRealPath(), $video->getClientMimeType(), $video->getClientOriginalName());
//        $input["video_thumb"] = curl_file_create($video_thumb->getRealPath(), $video_thumb->getClientMimeType(), $video_thumb->getClientOriginalName());
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