<?php

namespace App\Providers;

use App\Models\student;
use App\Models\User;
//use Illuminate\Foundation\Auth\User;
use App\Policies\StudentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define('edit-student',function(User $user,student $student){
               return $user->id===$student->user_id;
        });

        Gate::define('teachers',function(User $user){
            return $user->user_type==="teacher";
        });


         Gate::define('admins', function ($user) {
            return $user->user_type === 'admin';
        });

          Gate::define('users', function ($user) {
            return $user->user_type === 'user';
        });

             Gate::define('students', function ($user) {
            return $user->user_type === 'student';
        });
        // Define gate for teacher OR admin
        Gate::define('teacher-or-admin', function ($user) {
            return in_array($user->user_type, ['teacher', 'admin']);
        });

            // ✅ register student policy
        Gate::policy(student::class, StudentPolicy::class);
    }
}
