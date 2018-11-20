<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remote extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'ip_address', 'name', 'description'
    ];

    protected $dates = ['deleted_at'];
}
