<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeSchedule extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
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

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'user_id',
        'type',
        'from',
        'from_flex',
        'to',
        'to_flex',
        'shift_id',
        'remarks',
    ];
}
