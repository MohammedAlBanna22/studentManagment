<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\homeSchoolController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


route::prefix('school')->controller(homeSchoolController::class)->group(function(){

route::get('/','index')->name('school.index');
route::get('/aboutus','aboutUs')->name('school.aboutUs');
route::get('contactus','contactUs')->name('school.contactUs');

});

Route::get('/', function () {
    return view('welcome');
});


//for test learning
route ::prefix("detail")->group(function(){
    route::get('students',function(){
        return ('this student page')    ;
    })->name('student-Details');
    route::get('teachers',function(){
        return ('this teacher page');
    })->name('teachers-Details');

});
//route::get('student/{id}/{reg}',function($id,$reg){
   // return "this student id"  .$id.   "&& reg".$reg;
//});
route::fallback(function(){
    return('this is page not found  ');
});
route::get('about-us/{name}/{email}',function($name,$id){
    //$name="mohammed";
    //$email="mohammed@gmail.com";
   // $id=5;
   //return view ('about us')->with('name',$name)->with('id',$id);
//return view ('about us',['name'=>$name,'id'=>$id]);
   // return view('aboutus',compact('name','id'));
});
route::view('/contact-us/{name}/{id}','contactus');