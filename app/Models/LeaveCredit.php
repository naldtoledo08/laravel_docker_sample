<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveCredit extends Model
{
    protected $table = 'leave_credits';
    protected $fillable = [
    	'user_id', 'leave_type_id', 'description', 'nb_of_days', 'from', 'to', 'description'
    ];

    public function leaveType()
    {
    	return $this->belongsTo('App\Models\LeaveType');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
