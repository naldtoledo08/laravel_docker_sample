<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Timesheet extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    
    //
    protected $fillable = [
    	'user_id', 'date', 'time_in', 'time_out', 'time_in_ip', 'time_out_ip', 'remarks'
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'user_id', 'date', 'time_in', 'time_out', 'time_in_ip', 'time_out_ip', 'remarks'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
