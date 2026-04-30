<?php

use App\Http\Controllers\studentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::prefix('teacher')
->controller(TeacherController::class)
//  ->middleware(['auth', 'can:teacher-or-admin'])
    ->middleware(['auth', 'role:teacher,admin'])
    ->name('teacher.')
    ->group(function () {
        Route::get('show/{id}', 'showByid')->name('show');

    });



Route::middleware(['auth', 'can:teacher-or-admin'])
->name('students.')
->group(function () {
    Route::get('/students', [studentController::class, 'index'])
        ->name('index');
});
