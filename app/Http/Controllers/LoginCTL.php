<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 24/2/2558
 * Time: 3:24
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginCTL extends Controller {
    public function postIndex(Request $request){
        if($request->input("username") == "test" && $request->input("password") == "111111"){
            Session::put("userlogin", ["username"=> "test"]);
            return redirect(URL::to("/content"));
        }
        else {
            Session::flush();
            return redirect(URL::to("/auth/login"));
        }
    }
}