<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name', 'description'
    ];

    protected $dates = ['deleted_at'];

    public function leaveCredit()
    {
    	return $this->hasOne('App\Models\LeaveCredit');
    }

}
