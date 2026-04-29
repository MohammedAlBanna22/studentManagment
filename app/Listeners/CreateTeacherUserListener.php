<?php

namespace App\Listeners;

use App\Events\TeacherRegisterEvent;
use App\Models\images;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class CreateTeacherUserListener
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
    public function handle(TeacherRegisterEvent $event): void
    {
        //
        $teacher=$event->teacher;
//dd($teacher->name, $teacher->email, $teacher->password);
        $user=User::create([
            'name'=>$teacher->name,
            'email'=>$teacher->email,
            'password'=>Hash::make($event->password),
            'user_type'=>'teacher'
        ]);
        $teacher->user_id=$user->id;
        $teacher->save();

 if ($event->imagePath) {
        $images = new images();
        $images->path=$event->imagePath;
        $images->imageable_id=$teacher->id;
        $images->imageable_type=teacher::class;
        $images->save();
 }
    }
}