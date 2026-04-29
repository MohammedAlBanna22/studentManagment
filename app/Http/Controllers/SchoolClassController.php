<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    //
    public function index(Request $request){
        //return classes::with('students','teacher')->get();
         // $class=SchoolClass::with('subjects')->get();
          // $class=SchoolClass::get()->all();
            //$classes = SchoolClass::all();
       // return view('classes.index',compact('classes'));

            $classes = SchoolClass::
            when($request->search, function ($query) use ($request) {
                return $query->whereAny([
                 'name',
                ], 'like', '%' . $request->search . '%');
            })->paginate(10);
          return view('classes.index',compact('classes'));

    }

    public function addbyteacher($id){
        $teacher= teacher::findOrFail($id);
        $teacher_id=$teacher->id;


                // All classes to choose from
        $classes = SchoolClass::all();

        // Only subjects assigned to this teacher via subject_teacher pivot
        $subjects = subject::whereHas('teachers', function ($query) use ($teacher_id) {
                $query->where('subject_teacher.teacher_id', $teacher_id);
            })
            ->select('id', 'name')
            ->get();
//dd($classes,$subjects,$teacher);
       // return view ('classes.add',compact('Id'));
         return view('classes.addbyteacher', compact('classes', 'subjects', 'teacher', 'teacher_id'));

    }


public function create(Request $request)
{
    $request->validate([
        'class_id'   => 'required|exists:classes,id',
        'subject_id' => 'required|exists:subjects,id',
        'teacher_id' => 'required|exists:teachers,id',
    ]);

    $class = SchoolClass::findOrFail($request->class_id);

    // Check duplicate
    $exists = $class->teacher()
                    ->wherePivot('teacher_id', $request->teacher_id)
                    ->wherePivot('subject_id', $request->subject_id)
                    ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Already assigned!');
    }

    // Attach via pivot
    $class->teachers()->attach($request->teacher_id, [
        'subject_id' => $request->subject_id,
    ]);

    return redirect()->back()->with('success', 'Class assigned successfully!');
}

public function add(){
    // add course from admin to all teacher
    return view('classes.add');
}

public function store(Request $request){
        $class= new SchoolClass();
        $class->name=$request->name;
        $class->description=$request->description;

        $class->save();
        session()->flash('success','class added successfully');
        return redirect('class');

    }


    public function delete($id){
    $class= SchoolClass::findOrFail($id);
      $class->delete();
    return redirect()->route('SchoolClass.index')->with('success', 'Class deleted successfully.');
    }

    public function edit($id){
        $class=SchoolClass::findOrFail($id);
        return view('classes.edit',compact('class'));
    }

    public function updateClass(Request $request, SchoolClass $class )
    {

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $class->fill($validated);


    if ($class->isDirty()) {
        $class->save();

        return redirect()->route('SchoolClass.index')
            ->with('success', 'Class updated successfully!');
    }

    return redirect()->route('SchoolClass.index')
        ->with('info', 'No changes detected.');


    }



}
