<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveCredit extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'leave_credits';
    protected $fillable = [
    	'user_id', 'leave_type_id', 'description', 'num_of_days', 'from', 'to', 'description', 'is_approve'
    ];

    public function leaveType()
    {
    	return $this->belongsTo('App\Models\LeaveType');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'user_id', 'leave_type_id', 'description', 'num_of_days', 'from', 'to', 'description', 'is_approve'
    ];
}
