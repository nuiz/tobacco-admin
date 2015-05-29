<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 29/5/2558
 * Time: 7:25
 */

namespace App\Http\Controllers;


use App\Http\Api;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Session;

class ContentExamCTL extends Controller {
    public function getIndex(){
        $u = Session::get("userlogin");
        $params = array_merge($_GET, ["auth_token"=> $u->auth_token, "req_from_management"=> 1]);
        $resContent = Api::get("/content/{$params["content_id"]}?".http_build_query($params));
        $res = Api::get("/content/exam/{$params["content_id"]}?".http_build_query($params));
        return view("content/exam/index", ['items'=> $res, 'content'=> $resContent]);
    }

    public function postIndex(){
        $u = Session::get("userlogin");
        $req = Request::createFromGlobals();

        $input = $req->input();
        foreach($input["questions"][0]["choices"] as $key=> $value){
            $input["questions"][0]["choices"][$key]["is_answer"] = $input["answer"]==$key? 1: 0;
        }

        $res = \Unirest\Request::post(Api::BASE_URL."/content/exam?auth_token=".$u->auth_token, [], $input);
        return json_encode($res->body);
    }

    public function getRemove(){
        $req = Request::createFromGlobals();
        $id = $req->input("question_id");
        $u = Session::get("userlogin");
        $res = \Unirest\Request::delete(Api::BASE_URL."/content/exam/question/{$id}?auth_token=".$u->auth_token);
        $redir = @$_SERVER["HTTP_REFERER"];
        if(!$redir) $redir = "exam?content_id=".$req->input("content_id");

//        var_dump(Api::BASE_URL."/exam/question/{$id}?auth_token=".$u->auth_token);
//        print_r($res->body);
//        exit();

        return redirect($redir);
    }

    public function postEditquestion(){
        $u = Session::get("userlogin");
        $req = Request::createFromGlobals();

        $input = $req->input();


        $url = Api::BASE_URL."/content/exam/question/{$input["question_id"]}?auth_token=".$u->auth_token;
        $res = \Unirest\Request::put($url, [], $input);
        return json_encode($res->body);
    }
}