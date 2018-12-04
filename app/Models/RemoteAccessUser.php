<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RemoteAccessUser extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'user_id', 'from', 'to', 'reason', 'is_approve'
    ];
    
}
