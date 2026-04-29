<?php

namespace App\Models;

use App\Models\SchoolClass;
use App\Models\teacher;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    //
protected $fillable = ['name'];

 public function teachers()
{
    return $this->belongsToMany(
            teacher::class,       // Related model
            'subject_teacher',    // Pivot table
            'subject_id',         // Foreign key on pivot table for this model
            'teacher_id'          // Foreign key on pivot table for the related model
        )
        //->withPivot('subject_teacher') // Optional, if your pivot table has extra column
        ->withTimestamps();
}






    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class);
    }

    public function students()
{
    return $this->belongsToMany(student::class, 'grades')
                ->withPivot('teacher_id', 'grade')
                ->withTimestamps();
}
}