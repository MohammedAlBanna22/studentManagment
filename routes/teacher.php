<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')
->controller(RequestController::class)
 ->middleware(['auth' ,'verified'])
 ->name('requests.')
    ->group(function () {
        Route::get('requests','index')->name('index');
         Route::get('requests/create','create')->name('create');
         Route::post('requests','store')->name('store');
    });
