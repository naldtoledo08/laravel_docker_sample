<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemoteAccessUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id', 'from', 'to', 'reason', 'is_approve'
    ];

    protected $dates = ['deleted_at'];

    /**
     *  Get the user associated to the remote access
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
