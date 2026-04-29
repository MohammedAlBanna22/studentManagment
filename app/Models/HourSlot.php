<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HourSlot extends Model
{
    //
     protected $fillable = ['label', 'from_time', 'to_time', 'period', 'sort'];
}