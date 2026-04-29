<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\teacher;
use App\Models\student;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
       // $alluser=User::with('student','teacher')->get();
      // $teachers=teacher::with('user')->get();
      $students=student::with('user')->get();

        return $students;

    }
}
