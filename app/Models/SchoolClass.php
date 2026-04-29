<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SchoolClass extends Model
{
    //
        protected $table = 'classes';

        protected $fillable = [
        'name',
        'description',
        'id',
        'teacher_id'
    ];

    public function students(){
        return $this->hasMany(student::class,'class_id');

    }

    public function teacher(){
        return $this->belongsToMany(teacher::class,'class_teacher','class_id',"teacher_id");
    }


       public function teachers()
    {
        return $this->belongsToMany(teacher::class, 'class_teacher', 'class_id', 'teacher_id')
                    ->withPivot('subject_id')
                    ->withTimestamps();
    }

    public function subjects(){
        return $this->belongsToMany(subject::class,'class_subjects','class_id',"subject_id");
    }


}