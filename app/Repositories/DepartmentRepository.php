<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\BaseRepository;


class DepartmentRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Department $model)
    {
        $this->model = $model;
    }

    public function pluck(){
    	return $this->model::pluck('name','id')->all();
    }

}