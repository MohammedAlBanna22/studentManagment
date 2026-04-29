<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SessionDemoController extends Controller
{
    //
    public function index(){
        session(['favorite_color'=>'blue']);
        $session= session('favorite_color');
       // session()->flash('Status','You visited anew page');
       session()->forget('favorite_color');
        return session()->all();
    }
}
