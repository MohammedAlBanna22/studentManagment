<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//custom middleware to be 'teachers insted TeacherMiddleware::class write it in bootestrap app abd make route also in app in bootstrap
route::prefix('teacher')
->controller(TeacherController::class)
->middleware(['auth', 'role:admin'])
->group(function(){
route::get('/','index')->name('teacher.index');
route::get('add','addTeacher');
Route::post('add','store');
route::post('update/{id}','update');
route::get('edit/{id}', 'edit');
route::get('delete/{id}','delete');

});




// ── Admin ────────────────────────────────────────────
Route::middleware('auth')
->prefix('admin')
->controller(ScheduleController::class)
->name('admin.')
->group(function () {
    Route::get('schedule','index')->name('schedule.index');
    Route::post('schedule', 'store')->name('schedule.store');
    //  ajax BEFORE wildcard
    Route::get('schedule/free-slots','freeSlots')->name('schedule.free-slots');
       // wildcard LAST
    Route::get('schedule/{teachingRequest}/assign','assign')->name('schedule.assign');
    Route::get('schedule/free-rooms','freeRooms')->name('schedule.free-rooms');
    Route::get('/schedule/free-classes','freeClasses')
        ->name('schedule.free-classes');
    Route::patch('/schedule/requests/{id}/decline','decline');
    Route::get('schedule/requests/fetch','fetchByStatus');
});
