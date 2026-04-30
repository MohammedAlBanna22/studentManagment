<?php


use App\Http\Controllers\GradeController;
use App\Http\Controllers\SchoolClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




//edit role
route::prefix('class')
->controller(SchoolClassController::class)
->name("SchoolClass.")
->group(function(){
route::get('/','index')->name('index')->middleware('role:admin');
route::get('add/{id}','addbyteacher')->name('addByteacher')->middleware('role:teacher');
route::get('add','add')->name('add')->middleware('role:admin');
route::post('store','store')->name('store')->middleware('role:admin');
route::post('create','create')->name('create')->middleware('role:admin');
//route::delete('delete/{id}','destroy')->name('SchoolClass.delete');
route::get('edit/{id}','edit')->name('edit')->middleware('role:admin');
route::post('update/{class}','updateClass')->name('update')->middleware('role:admin');
route::delete('delete/{id}','delete')->name('delete')->middleware('role:admin');

});