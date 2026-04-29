<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\TeachingRequest;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        $requests = TeachingRequest::with(['teacher.user', 'subjects', 'availability'])
            ->where('status', 'pending')
            ->latest()->get();
            $counts = TeachingRequest::selectRaw("
                COUNT(*)                 as total,
                SUM(status = 'approved') as approved,
                SUM(status = 'pending')  as pending,
                SUM(status = 'declined') as declined
             ")
            ->first();

        return view('admin.schedule.index', compact('requests','counts'));
    }

    public function assign(TeachingRequest $teachingRequest)
    {
        return view('admin.schedule.assign', [
            'req' => $teachingRequest->load(['teacher.user', 'subjects', 'availability']),
        ]);
    }

    // ajax → returns free hour slots for teacher on day+period
    public function freeSlots(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'day'        => 'required|in:sun,mon,tue,wed,thu,fri',
            'period'     => 'required|in:A,B,both',
        ]);

        return response()->json(
            Schedule::freeHourSlots($data['teacher_id'], $data['day'], $data['period'])
        );
    }

    // ajax → returns free rooms for day+hour_slot
    public function freeRooms(Request $request)
    {
        $data = $request->validate([
            'day'          => 'required|in:sun,mon,tue,wed,thu,fri',
            'hour_slot_id' => 'required|exists:hour_slots,id',
        ]);

        return response()->json(
            Schedule::freeRooms($data['day'], $data['hour_slot_id'])
        );
    }


    public function freeClasses(Request $request)
{
    $data = $request->validate([
        'day' => 'required|in:sun,mon,tue,wed,thu,fri',
        'hour_slot_id' => 'required|exists:hour_slots,id',
    ]);

    return response()->json(
        Schedule::freeClasses($data['day'], $data['hour_slot_id'])
    );
}

  public function store(Request $request)
{
    $data = $request->validate([
        'teaching_request_id' => 'required|exists:teaching_requests,id',
        'subject_ids'         => 'required|array|min:1',
        'subject_ids.*'       => 'exists:subjects,id',
        'days'                => 'required|array|min:3',
        'days.*.hour_slot_id' => 'required|exists:hour_slots,id',
        'days.*.class_id'     => 'required|exists:classes,id',
    ]);

    $req = TeachingRequest::findOrFail($data['teaching_request_id']);

    $errors = [];

    // Check conflicts for every day × subject combination before inserting anything
    foreach ($data['days'] as $day => $pick) {
        // Teacher conflict: already teaching at this slot on this day
        $teacherConflict = Schedule::where('day', $day)
            ->where('hour_slot_id', $pick['hour_slot_id'])
            ->where('teacher_id', $req->teacher_id)
            ->exists();

        if ($teacherConflict) {
            $errors[] = "Teacher already has a class on {$day} at this slot.";
        }

        // Class conflict: room already booked at this slot on this day
        $classConflict = Schedule::where('day', $day)
            ->where('hour_slot_id', $pick['hour_slot_id'])
            ->where('class_id', $pick['class_id'])
            ->exists();

        if ($classConflict) {
            $errors[] = "Class is already booked on {$day} at this slot.";
        }
    }

    if (!empty($errors)) {
        return back()->withErrors($errors)->withInput();
    }

    // All clear — insert one Schedule row per day × subject
    foreach ($data['days'] as $day => $pick) {
        foreach ($data['subject_ids'] as $subjectId) {
            Schedule::create([
                'teacher_id'   => $req->teacher_id,
                'subject_id'   => $subjectId,
                'class_id'     => $pick['class_id'],
                'hour_slot_id' => $pick['hour_slot_id'],
                'day'          => $day,
            ]);
        }
    }

    $req->update(['status' => 'approved']);

    return redirect()->route('admin.schedule.index')
        ->with('success', 'Schedule assigned successfully!');
}


public function decline($id)
{
    $request = TeachingRequest::findOrFail($id);

    $request->update([
        'status' => 'declined'
    ]);

    return response()->json([
        'message' => 'Request declined successfully'
    ]);
}


public function fetchByStatus(Request $request)
{
    $status = $request->get('status', 'all');

    $query = TeachingRequest::with(['teacher.user', 'subjects', 'availability'])
        ->latest();

    if ($status !== 'all') {
        $query->where('status', $status);
    }

    $requests = $query->get();

    return view('admin.schedule.rows', compact('requests'))->render();
}


}
