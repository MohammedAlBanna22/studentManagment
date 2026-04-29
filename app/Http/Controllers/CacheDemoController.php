<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CacheDemoController extends Controller
{
    //
    public function index(){
        //
        Cache::put('foo','hello',6);
       // cache::put('abc','123456');
            //$value=Cache::get('foo');
            cache::forget('abc');//because put is strong on get
            cache::flush();
       $value=cache::get('abc','notfound');

        return $value;
    }
}
