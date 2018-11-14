<?php

namespace App\Services;

use App\Repositories\TimesheetRepository;
use Hash;

class TimesheetService
{
	private $timesheetRepo;

	public function __construct(TimesheetRepository $timesheetRepo)
	{
		$this->timesheetRepo = $timesheetRepo;
	}

	public function getInitialData($user_id)
	{
		return $this->timesheetRepo->getInitialData($user_id);
	}

	public function create($data)
	{
        $result = $this->timesheetRepo->create($data);
        return $result;
	}

	public function update($data, $id)
	{
        $timesheet = $this->timesheetRepo->find($id);
        $result = $timesheet->update($data);
        return $result;
	}

	public function delete($id)
	{
		return $this->timesheetRepo->delete($id);
	}
	
	public function getDaysBefore($number_of_days)
	{
		$date = date('Y-m-d', strtotime('now'));
		$dates[0] = $date;

		while ($number_of_days > 1) {
			$dates[] = $date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
			$number_of_days--;
		}

		return $dates;
	}

	/**
	 * $user - auth user
	 * $type - login or logout
	 */
	public function getRemarks($user, $type)
	{
		if($user->hasRole('admin')) {
			return 'Admin '. $type . ' at '.date('Y-m-d h:i:s');
		}
	}


	/**
	 * 
	 */
	public function getUsersTimesheetSummary()
	{
		return $this->timesheetRepo->getUsersTimesheetSummary();
	}

}