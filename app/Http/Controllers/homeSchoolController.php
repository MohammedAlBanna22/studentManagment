<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeSchoolController extends Controller
{
    //
    public function index(){
        return view ('school.index');
    }

     public function aboutUs(){
        return view('school.aboutUs');
     }

     public function contactUs(){
        return view ('school.contactUs');
     }
}