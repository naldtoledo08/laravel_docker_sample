<?php

namespace App\Repositories;

use App\Models\User;
use DB;

class UserRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function deleteRoles($id)
    {
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    }

    public function pluck(){
        return $this->model::pluck('name','id')->all();
    }

}