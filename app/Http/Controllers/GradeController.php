<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //
     public function createstd(student $student)
    {
        $teachers = teacher::select('id', 'name')->get();

        return view('student.add-subject', compact('student', 'teachers'));
    }

    // AJAX — subjects filtered by teacher
    public function subjectsByTeacher($teacher_id)
    {
        $subjects = teacher::findOrFail($teacher_id)
                           ->subjects()
                           ->select('subjects.id', 'subjects.name')
                           ->get();

        return response()->json($subjects);
    }


    // Get all subjects for dropdown on page load
public function create(student $student)
{
    $subjects = subject::select('id', 'name')->get();

    return view('student.add-subject', compact('student', 'subjects'));
}

// AJAX — teachers filtered by subject
    public function teachersBySubject($subject_id)
        {
            $teachers = subject::findOrFail($subject_id)
                       ->teachers()
                       ->select('teachers.id', 'teachers.name')
                       ->get();

            return response()->json($teachers);
        }





    // Store grade
    public function store(Request $request, student $student)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade'      => 'nullable|numeric|min:0|max:100',
        ]);

        // student_id auto set by relationship ✅
        $student->subjects()->syncWithoutDetaching([
            $request->subject_id => [
                'teacher_id' => $request->teacher_id,
                'grade'      => $request->grade,
            ]
        ]);

        return redirect()->route('student.profile', $student->id)
                         ->with('success', 'Subject added successfully!');
    }
}
