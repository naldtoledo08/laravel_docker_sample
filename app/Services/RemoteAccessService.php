<?php

namespace App\Services;

use App\Repositories\RemoteRepository;
use App\Repositories\RemoteAccessRepository;
use Hash;

class RemoteAccessService
{
	private $remoteRepo;
	private $remoteAccessRepo;

	public function __construct(RemoteRepository $remoteRepo, RemoteAccessRepository $remoteAccessRepo)
	{
		$this->remoteRepo = $remoteRepo;
		$this->remoteAccessRepo = $remoteAccessRepo;
	}

	public function isUserCanRemoteByDate($user_id, $date)
	{
		return $this->remoteAccessRepo->ifUserHasRemoteAccess($user_id, $date);
	}

	public function isUserIPAllowed($ip_address)
	{
        $result = $this->remoteRepo->findByParams(['ip_address' => $ip_address])->first();
        return $result;
	}



}