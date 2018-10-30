<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;
use Hash;

class UserService
{
	private $user;
	//private $department;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
		//$this->department = $department;
	}

	public function create($input)
	{
        $input['password'] = Hash::make($input['password']);

        $user = $this->user->create($input);

        $user->assignRole($input['roles']);

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

	public function update($input, $id){

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = $this->user->find($id);
        $user->update($input);

        // Delete roles before assigning new ones
        $this->user->deleteRoles($id);

        $user->assignRole($input['roles']);
	}
}