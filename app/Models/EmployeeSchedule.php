<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $fillable = [
    	'user_id',
    	'type',
    	'from',
    	'from_flex',
    	'to',
    	'to_flex',
    	'shift_id',
    	'remarks',
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
}
