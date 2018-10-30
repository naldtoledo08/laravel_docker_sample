<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //
    protected $fillable = [
    	'date', 'time_in', 'time_out', 'remarks'
    ];
}
