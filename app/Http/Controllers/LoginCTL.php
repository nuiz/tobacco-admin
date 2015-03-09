<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 24/2/2558
 * Time: 3:24
 */

namespace App\Http\Controllers;



use App\Http\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginCTL extends Controller {
    public function postIndex(Request $request){
        $res = \Unirest\Request::post(Api::BASE_URL."/login", [], $request->input());
        $data = $res->body;
        if(!isset($data->error)){
            Session::put("userlogin", $data);
            return redirect(URL::to("/content"));
        }
        else {
            Session::flush();
            return redirect(URL::to("/auth/login"));
        }
    }
}