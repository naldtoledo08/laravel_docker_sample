<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\EmployeeScheduleRepository;
use App\Repositories\LeaveCreditRepository;
use Hash;

class UserService
{
	private $user;
	private $empScheduleRepo;
	private $leaveCreditRepo;

	public function __construct(UserRepository $user,
								EmployeeScheduleRepository $empScheduleRepo,
								LeaveCreditRepository $leaveCreditRepo)
	{
		$this->user = $user;
		$this->empScheduleRepo = $empScheduleRepo;
		$this->leaveCreditRepo = $leaveCreditRepo;
	}

	public function create($input)
	{
        $input['password'] = Hash::make($input['password']);

        $user = $this->user->create($input);
                
        if(isset($input['roles'])) {
        	$user->assignRole($input['roles']);
        }else{
        	$this->setDefaultSchedule($user->id);
        }

        return $user;
	}

	public function paginate($record)
	{
		return $this->user->paginate($record);
	}

	public function find($id)
	{
		return $this->user->show($id);
	}

	public function update($input, $id)
	{
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = $this->user->find($id);
        $user->update($input);

        // Delete roles before assigning new ones
        $this->user->deleteRoles($id);

        if(isset($input['roles'])) {
	        $user->assignRole($input['roles']);
	    } else {
        	$this->setDefaultSchedule($user->id);
        }
	}

	public function findUsersExceptAdmin()
	{
		return $this->user->findUsersExceptAdmin();
	}

	public function updatePassword()
	{

	}

	public function resetPassword($email, $token)
	{
		
	}

	public function setDefaultSchedule($user_id)
	{
		return $this->empScheduleRepo->firstOrCreate([
			'user_id' => $user_id,
			'type' => 'semi-flexible',
			'from' => '08:00',
			'from_flex' => '09:00',
			'to' => '17:00',
			'to_flex' => '18:00',
			'shift_id' => 1
		]);
	}

	public function updateSchedule($data, $id)
	{
		return $this->empScheduleRepo->update($data, $id);
	}

	public function getUserAllInfo($id)
	{
		return $this->user->getUserAllInfo($id);
	}

	public function getRemainingLeavesPerType($user_id)
	{
		return $this->leaveCreditRepo->getRemainingLeavesPerType($user_id);
	}

	public function createLeave($data)
	{
		return $this->leaveCreditRepo->create($data);
	}


	
}