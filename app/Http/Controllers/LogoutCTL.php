<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 24/2/2558
 * Time: 4:16
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LogoutCTL extends Controller {
    public function getIndex(){
        Session::flush();
        return redirect(URL::to("auth/login"));
    }
}