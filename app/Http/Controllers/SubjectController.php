<?php

namespace App\Http\Controllers;

use App\Models\subject;
use App\Models\teacher;
use function Psy\sh;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    //
     Public function index(Request $request){
      $subjects=subject::  when($request->search, function ($query) use ($request) {
                return $query->whereAny([
                 'name',
                ], 'like', '%' . $request->search . '%');
            })->paginate(10);
      return view('Subjects.index',compact('subjects'));

     }

     public function store(Request $request){

      $validated = $request->validate([
        'name' => 'required|string|max:255',

    ]);
    $subject= new subject();
    $subject->name=$request->name;
    $subject->save();
        session()->flash('success','subject added successfully');
        return redirect('subject');
     }


        public function delete($id){
    $subject= subject::findOrFail($id);
      $subject->delete();
    return redirect()->route('subjects.index')->with('success', 'Class deleted successfully.');
    }



public function update(Request $request, $id)
{


     $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:subjects,name,' . $id,
    ]);
    if ($validator->fails()) {
        return redirect()->route('subjects.index')
            ->with('error', 'Subject name already exists.');
    }

    $subject = subject::findOrFail($id);

    if ($subject->name === $request->name) {
        return redirect()->route('subjects.index')->with('info', 'No changes were made.');
    }

    $subject->update(['name' => $request->name]);

    return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
}


/// THIS FOR SUBJECT PER TEACHER
     public function add($id){
        $teacher=teacher::findOrFail($id);
        $subjects = subject::all();


    return view('subjects.add', compact('teacher', 'subjects'));



     }

     public function create(Request $request){

 //dd($request->all());

    // Save in pivot table
            $request->validate([
             'teacher_id' => 'required|exists:teachers,id',
             'subject_ids' => 'required|array',
        ]);

        $teacher = teacher::findOrFail($request->teacher_id);
         //dd($teacher);


        $teacher->class()->detach();
     // Clean subjects array (remove empty values if any)
    $subjectIds = array_filter($request->subject_ids);

    // Save in pivot table
    $teacher->subjects()->sync($subjectIds);
//dd($teacher->id, $subjectIds);


    return redirect()->route('teacher.show', $teacher->id)
                     ->with('success', 'Subject assigned successfully');
     }
}
