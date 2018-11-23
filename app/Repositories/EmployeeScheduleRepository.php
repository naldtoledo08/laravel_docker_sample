<?php

namespace App\Repositories;

use App\Models\EmployeeSchedule;
use DB;

class EmployeeScheduleRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(EmployeeSchedule $employeeSchedule)
    {
        $this->model = $employeeSchedule;
    }

    public function firstOrCreate($data)
    {
    	return $this->model->firstOrCreate($data);
    }

}