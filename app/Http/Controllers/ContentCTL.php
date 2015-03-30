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
        $res = Api::get("/content?".http_build_query($_GET));
        $catRes = Api::get("/category/all");
        return view("content/index", ['items'=> $res->data, "category"=> $catRes->data]);
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
        $book_place = Api::get("/book_place");
        return view("content/addbook", ["category_tree"=> $category_tree, "book_types"=> $book_type->data, "book_place"=> $book_place]);
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

    public function getEditbook(){
        $req = Request::createFromGlobals();
        $category_tree = Api::get("/category/tree");
        $book_type = Api::get("/book_type");
        $book_place = Api::get("/book_place");
        $content = Api::get("/content/".$req->input("id"));
        return view("content/editbook", ["category_tree"=> $category_tree, "book_types"=> $book_type->data, "content"=> $content, "book_place"=> $book_place]);
    }

    public function postEditbook(){
        $req = Request::createFromGlobals();

        // user internal function add book
        $item = $this->_editBook($req);

        if($req->ajax()){
            return json_encode($item);
        }
        else {
            return redirect("content");
        }
    }

    public function getEditvideo(){
        $req = Request::createFromGlobals();
        $category_tree = Api::get("/category/tree");
        $content = Api::get("/content/".$req->input("id"));
        return view("content/editvideo", ["category_tree"=> $category_tree, "content"=> $content]);
    }

    public function postEditvideo(){
        $req = Request::createFromGlobals();

        // user internal function edit video
        $item = $this->_editVideo($req);

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
        if(!is_null($attach_files) && count($attach_files) > 0){
            foreach($attach_files as $key=> $attach_file){
                if(is_null($attach_file))
                    break;

                $input["attach_files"][$key] = curl_file_create($attach_file->getRealPath(), $attach_file->getClientMimeType(), $attach_file->getClientOriginalName());
            }
        }

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

        $attach_files = $req->file("attach_files");
        $input["attach_files"] = [];
        if(!is_null($attach_files) && count($attach_files) > 0){
            foreach($attach_files as $key=> $attach_file){
                if(is_null($attach_file))
                    break;

                $input["attach_files"][$key] = curl_file_create($attach_file->getRealPath(), $attach_file->getClientMimeType(), $attach_file->getClientOriginalName());
            }
        }

        $res = \Unirest\Request::post(Api::BASE_URL."/content?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }

    public function _editBook(Request $req){
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $book
         */
        $book = $req->file("book");
        $book_cover = $req->file("book_cover");

        $input = $req->input();
        if(!is_null($book)){
            $input["book"] = curl_file_create($book->getRealPath(), $book->getClientMimeType(), $book->getClientOriginalName());
        }
        if(!is_null($book_cover)){
            $input["book_cover"] = curl_file_create($book_cover->getRealPath(), $book_cover->getClientMimeType(), $book_cover->getClientOriginalName());
        }
        $input["content_type"] = "book";

        $id = $req->input("id");

        $res = \Unirest\Request::put(Api::BASE_URL."/content/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }

    public function _editVideo(Request $req){

        $input = $req->input();
        $input["content_type"] = "video";

        $id = $req->input("id");

        $res = \Unirest\Request::put(Api::BASE_URL."/content/{$id}?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return $res->body;
    }
}