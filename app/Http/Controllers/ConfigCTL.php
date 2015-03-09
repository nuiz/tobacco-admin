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

class ConfigCTL extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $res = Api::get("/config");
        $config = [];
        foreach($res as $key=> $value){
            $config[$value->config_name] = $value->config_value;
        }
        return view("config/index", ['config'=> $config]);
    }
}