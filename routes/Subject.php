<?php
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


route::prefix('subject')
->controller(SubjectController::class)
->middleware('role:admin')
->group(function(){
route::get('/','index')->name('subjects.index');
route::get('add/{id}','add')->name('Subjects.add');
route::post('create','create')->name('subject.create');
route::post('store','store')->name('subjects.store');
// Update subject (handles the edit form submission)
  Route::put('update/{id}', 'update')->name('subject.update');
//route::get('show/{id}','showByid');
route::post('update/{id}','updateSubject')->name('subject.updateSubject');
route::delete('delete/{id}','delete')->name('subject.delete');

});



// AJAX route — outside prefix group, no 'grades/' prefix needed
Route::get('/api/subjects-by-teacher/{teacher_id}', [GradeController::class, 'subjectsByTeacher'])->name('grade.subjects');

Route::get('/api/teachers-by-subject/{subject_id}', [GradeController::class, 'teachersBySubject'])->name('grade.teachers');




route::prefix('grades')->controller(GradeController::class)->group(function(){
 Route::get('addsubject/{student}',  'create')->name('grade.create');
    Route::post('store/{student}',      'store')->name('grade.store');

});
