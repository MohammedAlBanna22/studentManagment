<?php

namespace App\Http\Controllers;

use App\Jobs\ResultsJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class EmailsController extends Controller
{
    //
    public function welcomeEmail(){

         //Mail::to('mahmoud2010b4@gmail.com')->send(new WelcomeMail());
        $students= User::where('user_type','student')
                    ->limit(10)
                    ->get();

         foreach($students as$student){
            ResultsJob::dispatch($student->email);
         }

        return "email sent successfully";
    }
}
