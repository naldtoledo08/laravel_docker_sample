<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Remote;
use App\Repositories\RemoteRepository;
use Illuminate\Http\Request;

class RemotePolicy
{
    use HandlesAuthorization;

    private $remoteRepo;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->remoteRepo = new RemoteRepository(new Remote);
    }

    public function remote_access(User $user)
    {    
        $ip_address = \Request::ip();
        $result = $this->remoteRepo->findByParams(['ip_address' => $ip_address])->first();

        return $result ? true : false;
    }
}
