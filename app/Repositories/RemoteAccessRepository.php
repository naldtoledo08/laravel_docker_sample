<?php

namespace App\Repositories;

use App\Models\RemoteAccessUser;
use App\Repositories\BaseRepository;


class RemoteAccessRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(RemoteAccessUser $model)
    {
        $this->model = $model;
    }

    public function ifUserHasRemoteAccess($user_id, $date)
    {
    	$date = date('Y-m-d', strtotime($date));

    	$result = $this->model->where('user_id', $user_id)
    				->where('from', '<=', $date)
                    ->where('to', '>=', $date)
    				->where('approve', 1)
    				->first();

    	return $result ? true : false;
    }
}