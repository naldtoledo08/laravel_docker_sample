<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\BaseRepository;


class PositionRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Position $model)
    {
        $this->model = $model;
    }

    public function pluck(){
    	return $this->model::pluck('title','id')->all();
    }

}