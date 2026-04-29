<?php

namespace App\Models;

use App\Models\student;
use App\Models\subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class grades extends Pivot
{
    //
    protected $table = 'grades';

    public function teacher()
    {
        return $this->belongsTo(teacher::class, 'teacher_id');
    }

        public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }

}