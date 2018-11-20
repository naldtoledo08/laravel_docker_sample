<?php

namespace App\Repositories;

use App\Models\Remote;
use App\Repositories\BaseRepository;


class RemoteRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Remote $model)
    {
        $this->model = $model;
    }

}