<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //
    protected $fillable = [
    	'user_id', 'date', 'time_in', 'time_out', 'remarks'
    ];
}
