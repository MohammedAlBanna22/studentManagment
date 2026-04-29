<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingRequestAvailability extends Model
{
    //
    protected $table = 'teaching_request_availability';
     public $timestamps = false;
    protected $fillable = ['teaching_request_id', 'day', 'period'];
}