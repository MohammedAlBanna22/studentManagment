<?php

namespace App\Models;

use App\Models\SchoolClass;

use App\Models\student;
use App\Models\subject;
use function Symfony\Component\String\s;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    //
     protected $fillable = ['name'];
    public function user(){
    return $this->belongsTo(user::class,'user_id','id');
}


public function ownedClasses(){
    return $this->hasMany(SchoolClass::class,'teacher_id','id');
}

public function studentperclass(){
    return $this->hasManyThrough(student::class,SchoolClass::class,'teacher_id','class_id');
}



   public function students()
    {
        return $this->belongsToMany(
            student::class,
            'grades',
            'teacher_id',
            'student_id'
        )
        ->withPivot('subject_id', 'grade')
        ->withTimestamps();
    }

public function images(){
    return $this->morphMany(images::class,'imageable');
}

public function subjects()
{



        return $this->belongsToMany(
        subject::class,
        'subject_teacher',
        'teacher_id',
        'subject_id'
    )->withTimestamps();
}

public function class()
{



        return $this->belongsToMany(
        SchoolClass::class,
        'class_teacher',
        'teacher_id',
        'class_id'
  )->withPivot('subject_id')
    ->withTimestamps();
}

    public function schedules(){
        return $this->hasMany(Schedule::class);
         }
    public function teachingRequests(){
        return $this->hasMany(TeachingRequest::class);
        }


}