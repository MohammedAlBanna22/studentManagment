<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'age'];

    // OR
    protected $guarded = [];

    /*
    protected $hidden = [
        'name',
        'age',
    ];
    */
    public function scopeMale($query, $age)
    {
        return $query->where('gender', 'm')
            ->where('age', '=', $age);

    }

    public function scopeFemale($query)
    {
        return $query->where('gender', 'f');

    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }

    public function className()
    {
        return $this->belongsToMany(
            SchoolClass::class,
            'class_subjects',
            'subject_id',
            'class_id');
    }


       // ✅ Add this
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(
            subject::class,
             'grades',
              'student_id',
               'subject_id')
            ->using(grades::class)
            ->withPivot('grade', 'teacher_id')
            ->withTimestamps();
    }

    public function teacher()
    {
        return $this->hasOneThrough(
            teacher::class,
            SchoolClass::class,
            'id',
            'id',
            'class_id',
            'teacher_id'

        );
    }

    public function images()
    {
        return $this->morphMany(images::class,'imageable');
    }
}
