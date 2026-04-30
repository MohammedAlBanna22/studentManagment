<?php

use App\Http\Controllers\studentController;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::prefix('student')->controller(studentController::class)
->middleware('auth','verified')
->name('student.')
->group(function(){

route::view('add','student.add')->name('add');;
route::post('create','create')->name('create');;
route::get('edit/{id}','edit')->name('edit');;
route::post('update/{id}','update')->name('update');
route::delete('delete/{id}','destroy')->name('delete');
route::get('profile/{id}','profile')->name('profile');

route::get('get','getstd')->name('getstd');;
route::get('getall','getstudents');
route::get('softdelete','softdel')->name('softdel');;

route::delete('/students/{student}/subjects/{subject}', 'removeSubject'
)->name('subject.delete');




//for test
route::get('all','index')->name('index');
route::get('about','about');
route::get('aboutus/{id}/{name}','aboutUs');
route::get('private','privateexcute');
route::resource('test',testController::class);


route::get('addstudent','addstudent')->name('addstd');
route::get('updatestudent','updateStudent')->name('updatestd');
route::get('deletestd','deleteStudent')->name('del');;
route::get('wheretest','wherecondition');
route::get('query','queryscope');
route::get('secondquery','secondquery');



});
