<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveType extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'leave_types';
    protected $fillable = [
    	'name', 'description'
    ];

    protected $dates = ['deleted_at'];

    public function leaveCredit()
    {
    	return $this->hasOne('App\Models\LeaveCredit');
    }

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'name', 'description'
    ];

}
