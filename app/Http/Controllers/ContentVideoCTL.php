<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 18/3/2558
 * Time: 10:51
 */

namespace App\Http\Controllers;


use App\Http\Api;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Session;

class ContentVideoCTL extends Controller {
    public function getIndex(){
        $req = Request::createFromGlobals();
        $content_id = $req->input("content_id");

        $content = Api::get("/content/".$content_id);
        return view('content/video/index', ['content'=> $content]);
    }

    public function postIndex(){
        $req = Request::createFromGlobals();
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */
        $videos = $req->file("videos");
        $videos_thumb = $req->file("videos_thumb");

        $content_id = $req->input("content_id");

        $input = $req->input();
        $input["videos"] = [];
//        if(count($videos) != count($videos_thumb)){
//            return ResponseHelper::error();
//        }
        foreach($videos as $key=> $video){
            $input["videos"][$key] = curl_file_create($video->getRealPath(), $video->getClientMimeType(), $video->getClientOriginalName());
        }
        $input["videos_thumb"] = [];
        foreach($videos_thumb as $key=> $video_thumb){
            $input["videos_thumb"][$key] = curl_file_create($video_thumb->getRealPath(), $video_thumb->getClientMimeType(), $video_thumb->getClientOriginalName());
        }

        $u = Session::get("userlogin");
        $res = \Unirest\Request::post(Api::BASE_URL."/content/{$content_id}/video?auth_token=".$u->auth_token, [], $input);
        return json_encode($res->body);
    }

    public function postUpdate(){
        $req = Request::createFromGlobals();
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */

        $id = $req->input("id");

        $input = $req->input();
        $u = Session::get("userlogin");
        $res = \Unirest\Request::post(Api::BASE_URL."/content/video/{$id}/sort?auth_token=".$u->auth_token, [], $input);
        return json_encode($res->body);
    }

    public function postSort(){
        $req = Request::createFromGlobals();
        /**
         * @var \Symfony\Component\HttpFoundation\File\UploadedFile $video
         */

        $input = $req->input();
        $content_id = $input['content_id'];

        $u = Session::get("userlogin");
        $res = \Unirest\Request::post(Api::BASE_URL."/content/{$content_id}/video/sort?auth_token=".$u->auth_token, [], $input);
        return json_encode($res->body);
    }

    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");
        if(!is_array($id)){
            $id = [$id];
        }

        $u = Session::get("userlogin");
        $content_id = $req->input("content_id");
        $query = http_build_query([
            'list_id'=> $id,
            'content_id'=> $content_id,
            'auth_token'=> $u->auth_token
        ]);
        $res = \Unirest\Request::delete(Api::BASE_URL."/content/{$content_id}/video?".$query);

        if($req->ajax()){
            return json_encode($res);
        }
        else {
            return redirect("content/video?content_id=".$content_id);
        }
    }
}