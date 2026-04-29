<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingRequest extends Model
{
    //
     protected $fillable = ['teacher_id', 'status', 'notes'];

    public function teacher() {
        return $this->belongsTo(teacher::class);
         }
    public function subjects()     {
        return $this->belongsToMany(subject::class, 'teaching_request_subjects');
        }
    public function availability() {
        return $this->hasMany(TeachingRequestAvailability::class);
         }
}