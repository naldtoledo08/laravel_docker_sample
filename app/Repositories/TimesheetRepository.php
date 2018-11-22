<?php

namespace App\Repositories;

use App\Models\Timesheet;
use App\Repositories\BaseRepository;
use DB;


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

    public function getUsersTimesheetSummary()
    {
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', 'roles.id')

            ->leftJoin('departments', 'users.department_id', 'departments.id')
            ->leftJoin('positions', 'users.position_id', 'positions.id')
            ->leftJoin('timesheets', 'users.id', '=', 'timesheets.user_id')
            
            ->where('roles.name', '!=', "admin")->orWhere('roles.name', null)
            ->select('users.id', 'users.name', 'users.created_at', 'departments.name as department', 'positions.title as position', DB::raw('MAX(timesheets.time_in) as last_time_in'))
            ->groupBy('users.id')
            ->get();

        return $users;
    }
}