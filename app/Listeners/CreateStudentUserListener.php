<?php

namespace App\Listeners;

use App\Events\StudentRegisterEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStudentUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudentRegisterEvent $event): void
    {
        //
        $student=$event->student;

        $user=User::create([
            'name'=>$student->name,
            'email'=>$student->email,
            'password'=>bcrypt('password'),
            'user_type'=>'student'
        ]);
        $student->user_id=$user->id;
        $student->save();
    }
}
