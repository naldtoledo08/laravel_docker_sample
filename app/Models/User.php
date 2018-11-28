<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department_id', 'position_id', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];
    
    /**
     *  Get the department associated to the user
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     *  Get the department associated to the user
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    /**
     *  Get the schedule associated to the user
     */
    public function employee_schedule()
    {
        return $this->hasOne('App\Models\EmployeeSchedule');
    }


    /**
     *  Get the leave history associated to the user
     */
    public function leave_credits()
    {
        return $this->hasMany('App\Models\LeaveCredit');
    }
}
