<?php

namespace App\Http\Controllers;
use App\Events\TeacherRegister;
use App\Events\TeacherRegisterEvent;
use App\Http\Requests\StudentAddRequest;
use App\Http\Requests\TeacherAddRequest;
use App\Http\Requests\TeacherRequest;
use App\Models\images;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use tidyNode;


class TeacherController extends Controller
{
    //
    public function index(Request $request){
      //return teacher::with('classes')->get();
     // return teacher::with('students')->get();
       // return $teacher

         $teachers = teacher::with('images','user')->
            when($request->search, function ($query) use ($request) {
                return $query->whereAny([
                    'name',
                    'email',
                    'phone',
                ], 'like', '%' . $request->search . '%');
            })->paginate(10);
        return view('teacher.index', compact('teachers'));
    }
    public function addTeachers(){
        $teacher = new teacher;
        $teacher->name="new teacher name";
        $teacher->save();
        return "add teacher successfully";
    }
    public function showByid($id){
        $teacher = teacher::with('students','class','subjects')->findOrFail($id);
$subjectsWithStudents = $teacher->subjects->map(function($subject) use ($teacher) {

    $subject->studentList = student::whereHas('subjects', function($query) use ($teacher, $subject) {
            $query->where('subjects.id', $subject->id)
                  ->where('grades.teacher_id', $teacher->id); // ← use actual table.column
        })
        ->with('schoolClass')
        ->limit(5)
        ->get();

    $subject->total_students = student::whereHas('subjects', function($query) use ($teacher, $subject) {
            $query->where('subjects.id', $subject->id)
                  ->where('grades.teacher_id', $teacher->id); // ← use actual table.column
        })
        ->count();

    return $subject;
});




        return view('teacher.show',compact('teacher', 'subjectsWithStudents'));
       // return $teacher;
    }

    public function updateTeacher($id){
    $updateteacher = teacher::findorfail($id);
    $updateteacher->name= "updatedteacher";
    $updateteacher->update();
    return "update teacher successfully";

    }

public function delete($id){
    $teacher = teacher::findOrFail($id);
    $teacher->delete();
    return "delete successfully";
}

    // Show add form
    public function addTeacher()
    {
        return view('teacher.add');
    }
public function store(TeacherAddRequest $request){


        $imagePath=null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('photos/teachers','public');
        }

        $teacher= new teacher();
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->phone=$request->phone;
        $teacher->date_of_birth=$request->date_of_birth;
        $teacher->age=$request->age;
        $teacher->gender=$request->gender;

        $password=$request->password;
       // $student->image=$imagePath;
      //  $teacher->user_id=26;
          //$teacher->save();
         event(new TeacherRegisterEvent($teacher,$password,$imagePath));

//dd('event fired');

        session()->flash('success','teacher added successfully');
        return redirect('teacher');


    }


    public function edit($id)
{
    $teacher = teacher::findOrFail($id);
    return view('teacher.edit', compact('teacher'));
}

public function update(Request $request, $id)
{
    $teacher = teacher::findOrFail($id);

    // 1️⃣ Update teacher
    $teacher->name          = $request->name;
    $teacher->email         = $request->email;
    $teacher->phone         = $request->phone;
    $teacher->date_of_birth = $request->date_of_birth;
    $teacher->age           = $request->age;
    $teacher->gender        = $request->gender;
    $teacher->save();

    // 2️⃣ Update user
    $user = User::findOrFail($teacher->user_id);
    $user->name  = $request->name;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    $user->save();

    // 3️⃣ Update image only if new file uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('photos/teachers', 'public');

        if ($teacher->image) {
            // update existing image
            $teacher->image->path = $imagePath;
            $teacher->image->save();
        } else {
            // create new image if none exists
            $image                 = new images();
            $image->path           = $imagePath;
            $image->imageable_id   = $teacher->id;
            $image->imageable_type = teacher::class;
            $image->save();
        }
    }

    session()->flash('success', 'Teacher updated successfully');
    return redirect('teacher');
}



}
