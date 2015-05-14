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

class UserWriterCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $resCluster = Api::get("/account/cluster");
        $res = Api::get("/account/writer?".http_build_query($_GET));

        $fnBuild = function(&$value) use($resCluster){
            foreach($resCluster->data as $cluster){
                if($value->cluster_id == $cluster->account_id){
                    $value->cluster = $cluster;
                }
            }
        };

        foreach($res->data as $key=> $value){
            $fnBuild($res->data[$key]);
        }

        return view("user/writer/index", ["items"=> $res->data, 'clusters'=> $resCluster->data]);
    }

    public function getAdd(){
        $resCluster = Api::get("/account/cluster");
        $res = Api::get("/account/user");
        $u = Session::get("userlogin");
        return view("user/writer/add", ["users"=> $res->data, 'clusters'=> $resCluster->data, 'u'=> $u]);
    }

    public function postAdd(){
        $req = Request::createFromGlobals();

        $u = Session::get("userlogin");

        $res = \Unirest\Request::post(Api::BASE_URL."/account/upwriter?auth_token=".$u->auth_token, [], $req->input());
        return json_encode($res->body);
    }

    //delete
    public function getDelete(){
        $req = Request::createFromGlobals();
        $id = $req->input("id");

        $u = Session::get("userlogin");
        $res = \Unirest\Request::delete(Api::BASE_URL."/userwriter/{$id}?auth_token=".$u->auth_token);
        return redirect("userwriter");
    }
}