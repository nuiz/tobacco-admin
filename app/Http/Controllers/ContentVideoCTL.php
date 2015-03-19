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

        $res = \Unirest\Request::post(Api::BASE_URL."/content/{$content_id}/video?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], $input);
        return json_encode($res->body);
    }

    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");
        if(!is_array($id)){
            $id = [$id];
        }

        $content_id = $req->input("content_id");
        $res = \Unirest\Request::delete(Api::BASE_URL."/content/{$content_id}/video?auth_token=74a500a2eee1b8274dae468ddb4892fb", [], [
            'list_id'=> $id,
            'content_id'=> $content_id
        ]);

        if($req->ajax()){
            return json_encode($res);
        }
        else {
            return redirect("content");
        }
    }
}