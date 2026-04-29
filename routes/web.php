<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CacheDemoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\homeSchoolController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SessionDemoController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\teacher;
use Dom\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('welcome');
});
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

//route::get('students',[studentController::class,'index']);
route::controller(studentController::class)->group(function(){
route::get('students','index');
route::get('about','about');
route::get('aboutus/{id}/{name}','aboutUs');
route::get('private','privateexcute');
route::resource('test',testController::class);

});
//use more time teachercontroller
//route::get('teachers',[TeacherController::class,'index']);
//route::get('addteacher',[teacherController::class,'addTeacher']);
//custom middleware to be 'teachers insted TeacherMiddleware::class write it in bootestrap app
route::prefix('teacher')->controller(TeacherController::class)->middleware(['auth', 'role:admin'])->group(function(){
route::get('/','index')->name('teacher.index');
route::get('add','addTeacher');
//route::post('add','store');
Route::post('add','store');

route::post('update/{id}','update');
route::get('edit/{id}', 'edit');


route::get('delete/{id}','delete');




});


Route::prefix('teacher')->controller(TeacherController::class)
//  ->middleware(['auth', 'can:teacher-or-admin'])
    ->middleware(['auth', 'role:teacher,admin'])
    ->group(function () {
        Route::get('show/{id}', 'showByid')->name('teacher.show');

    });
           Route::get('requests',         [RequestController::class, 'index'])->name('requests.index');
         Route::get('requests/create',  [RequestController::class, 'create'])->name('requests.create');
         Route::post('requests',        [RequestController::class, 'store'])->name('requests.store');



route::prefix('student')->controller(studentController::class)->middleware('auth','verified')->group(function(){
route::get('addstudent','addstudent');
route::get('getall','getstudents');
route::get('updatestudent','updateStudent');
route::get('deletestd','deleteStudent');
route::get('wheretest','wherecondition');
route::get('query','queryscope');
route::get('secondquery','secondquery');
route::get('softdelete','softdel');
route::get('get','getstd');

route::view('add','student.add');
route::post('create','create');
route::get('edit/{id}','edit');
route::post('update/{id}','update');
route::delete('delete/{id}','destroy');
route::get('profile/{id}','profile')->name('student.profile');



route::delete('/students/{student}/subjects/{subject}', 'removeSubject'
)->name('student.subject.delete');

});


Route::middleware(['auth', 'can:teacher-or-admin'])->group(function () {
    Route::get('/students', [studentController::class, 'index'])
        ->name('students.index');
});


route::prefix('class')->controller(SchoolClassController::class)->group(function(){
route::get('/','index')->name('SchoolClass.index');
route::get('add/{id}','addbyteacher')->name('SchoolClass.addByteacher');
route::get('add','add')->name('SchoolClass.add');
route::post('store','store')->name('SchoolClass.store');
route::post('create','create')->name('SchoolClass.create');
//route::delete('delete/{id}','destroy')->name('SchoolClass.delete');
route::get('edit/{id}','edit')->name('SchoolClass.edit');
route::post('update/{class}','updateClass')->name('SchoolClass.update');
route::delete('delete/{id}','delete')->name('SchoolClass.delete');

});

route::prefix('grades')->controller(GradeController::class)->group(function(){
 Route::get('addsubject/{student}',  'create')->name('grade.create');
    Route::post('store/{student}',      'store')->name('grade.store');


});
// AJAX route — outside prefix group, no 'grades/' prefix needed
Route::get('/api/subjects-by-teacher/{teacher_id}', [GradeController::class, 'subjectsByTeacher'])->name('grade.subjects');

Route::get('/api/teachers-by-subject/{subject_id}', [GradeController::class, 'teachersBySubject'])->name('grade.teachers');


route::prefix('subject')->controller(SubjectController::class)->group(function(){
route::get('/','index')->name('subjects.index');
route::get('add/{id}','add')->name('Subjects.add');
route::post('create','create')->name('subject.create');
route::post('store','store')->name('subjects.store');
// Update subject (handles the edit form submission)
  Route::put('update/{id}', 'update')->name('subject.update');


//route::get('show/{id}','showByid');
route::post('update/{id}','updateSubject')->name('subject.update');
route::delete('delete/{id}','delete')->name('subject.delete');

});


route::get('users',[UserController::class,"index"]);

Auth::routes(['verify'=>true]);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Show verification notice page
Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

// Handle the verification link click
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend verification email
Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

route::get('/session',action: [SessionDemoController::class,'index']);

route::get('/demochace',action: [CacheDemoController::class,'index']);

route::get('send-mail',action: [EmailsController::class,'WelcomeEmail']);



route::prefix('school')->controller(homeSchoolController::class)->group(function(){

route::get('/','index')->name('school.index');
route::get('/aboutus','aboutUs')->name('school.aboutUs');
route::get('contactus','contactUs')->name('school.contactUs');

});




// ── Admin ────────────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('schedule',                           [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('schedule',                          [ScheduleController::class, 'store'])->name('schedule.store');
    // ⚠️ ajax BEFORE wildcard
    Route::get('schedule/free-slots',                [ScheduleController::class, 'freeSlots'])->name('schedule.free-slots');
    Route::get('schedule/free-rooms',                [ScheduleController::class, 'freeRooms'])->name('schedule.free-rooms');
    // wildcard LAST
    Route::get('schedule/{teachingRequest}/assign',  [ScheduleController::class, 'assign'])->name('schedule.assign');



    Route::get('/schedule/free-classes', [ScheduleController::class, 'freeClasses'])
        ->name('schedule.free-classes');

   Route::patch('/schedule/requests/{id}/decline', [ScheduleController::class, 'decline']);

   Route::get('schedule/requests/fetch', [ScheduleController::class, 'fetchByStatus']);


});
  Route::middleware('auth')->prefix('payment')->controller(PaymentController::class)->name('payment.')->group(function () {
    Route::get('/pay','showPaymentForm')->name('form');
    Route::post('/intent','createPaymentIntent')->name('intent');
    Route::post('/success','paymentSuccess')->name('success');
     Route::get('/','allPayment')->name('index')->middleware('role:admin');
    });
