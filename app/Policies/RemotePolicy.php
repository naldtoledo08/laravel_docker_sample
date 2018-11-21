<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Services\RemoteAccessService;
use Illuminate\Http\Request;

class RemotePolicy
{
    use HandlesAuthorization;

    private $remoteService;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(RemoteAccessService $remoteAccessService)
    {
        $this->remoteService = $remoteAccessService;
    }

    public function remote_access(User $user)
    {    
        $ip_address = \Request::ip();
        $date = date('Y-m-d', strtotime('now'));

        $ip_allowed = $this->remoteService->isUserIPAllowed($ip_address);
        $remote_access = $this->remoteService->isUserCanRemoteByDate($user->id, $date);

        return ($ip_allowed || $remote_access) ? true : false;
    }
}
