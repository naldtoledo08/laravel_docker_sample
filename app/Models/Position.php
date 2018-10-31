<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'title', 'description'
    ];

    protected $dates = ['deleted_at'];
    
    public function user(){
    	return $this->hasOne('App\Models\User');
    }
}