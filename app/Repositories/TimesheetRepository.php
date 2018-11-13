<?php

namespace App\Repositories;

use App\Models\Timesheet;
use App\Repositories\BaseRepository;


class TimesheetRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;
    private $initial_row = 10;
    // Constructor to bind model to repo
    public function __construct(Timesheet $model)
    {
        $this->model = $model;
    }

    public function getInitialData($user_id)
    {
    	return $this->findByUser($user_id)->keyBy('date')->take($this->initial_row);
    }

}