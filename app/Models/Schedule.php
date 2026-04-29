<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $fillable = [
        'teacher_id', 'subject_id', 'class_id',
        'hour_slot_id', 'day', 'academic_year',
    ];

    public function teacher()  { return $this->belongsTo(teacher::class); }
    public function subject()  { return $this->belongsTo(subject::class); }
    public function room()     { return $this->belongsTo(SchoolClass::class); }
    public function hourSlot() { return $this->belongsTo(HourSlot::class); }

    // free hour slots for a teacher on a day within a period (A, B, or both)
    public static function freeHourSlots(int $teacherId, string $day, string $period)
    {
        $busy = self::where('teacher_id', $teacherId)
                    ->where('day', $day)
                    ->pluck('hour_slot_id');

        return HourSlot::whereNotIn('id', $busy)
            ->when($period !== 'both', fn($q) => $q->where('period', $period))
            ->orderBy('sort')
            ->get();
    }

    // free rooms on a day + hour slot
    public static function freeRooms(string $day, int $hourSlotId)
    {
          $busyClasses = self::where('day', $day)
        ->where('hour_slot_id', $hourSlotId)
        ->pluck('class_id');

        return SchoolClass::whereNotIn('id', $busyClasses)->get();
    }


      public static function freeClasses(string $day, int $hourSlotId)
    {
          $busyClasses = self::where('day', $day)
        ->where('hour_slot_id', $hourSlotId)
        ->pluck('class_id');

        return SchoolClass::whereNotIn('id', $busyClasses)->get();
    }

}
