<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Hash;

class UserService
{
	private $user;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	public function create($input)
	{
        $input['password'] = Hash::make($input['password']);

        $user = $this->user->create($input);
                
        if(isset($input['roles'])) {
        	$user->assignRole($input['roles']);
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

        $user->assignRole($input['roles']);
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



}