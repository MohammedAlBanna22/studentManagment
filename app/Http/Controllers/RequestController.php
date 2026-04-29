<?php

namespace App\Http\Controllers;

use App\Models\subject;

use App\Models\TeachingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    //
     public function create()
    {
        return view('teacher.request.create', [
            'subjects' => subject::all(),
        ]);
    }

   public function store(Request $request)
{

 // dd($request->input('days'));
    $activeDays = $request->input('active_days', []);

    // Strip days not in active list
    $filteredDays = collect($request->input('days', []))
        ->only($activeDays)
        ->toArray();

    $request->merge(['days' => $filteredDays]);


    $data = $request->validate([
        'subjects'       => 'required|array|min:1',
        'subjects.*'     => 'exists:subjects,id',
        'days'           => 'required|array|min:3|max:6',
        'days.*.day'     => 'required|in:sun,mon,tue,wed,thu,fri',
        'days.*.period'  => 'required|in:A,B,both',
        'notes'          => 'nullable|string|max:1000',
    ]);



    $teacher = Auth::user()->teacher;

    if (!$teacher) {
        abort(403, 'Teacher not found');
    }

    $req = TeachingRequest::create([
        'teacher_id' => $teacher->id,
        'notes'      => $data['notes'] ?? null,
    ]);

    $req->subjects()->attach($data['subjects']);

    foreach ($data['days'] as $avail) {
        $req->availability()->create([
            'day'    => $avail['day'],      // ← only pass what DB needs
            'period' => $avail['period'],
        ]);
    }

    return redirect()->route('requests.index')
                     ->with('success', 'Request submitted!');
}

    public function index()
    {
        $requests = TeachingRequest::with(['subjects', 'availability'])
            ->where('teacher_id', Auth::user()?->teacher->id)//old  ->where('teacher_id', auth()->user()->teacher->id)
            ->latest()->get();

        return view('teacher.request.index', compact('requests'));
    }
}