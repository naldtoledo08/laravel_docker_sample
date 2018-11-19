<?php

namespace App\Repositories;

use App\Models\LeaveType;
use App\Repositories\BaseRepository;


class LeaveTypeRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(LeaveType $model)
    {
        $this->model = $model;
    }

    public function pluck(){
    	return $this->model::pluck('name','id')->all();
    }

}