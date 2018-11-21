<?php

namespace App\Repositories;

interface RepositoryInterface
{
	public function all();

	public function show($id);

	public function find($id);
	
	public function findByParams($params);

	public function create(array $data);
	
	public function update(array $data, $id);

	public function delete($id); 
}